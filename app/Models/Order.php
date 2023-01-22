<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Order
 *
 * @package namespace App\Models
 */
class Order extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'invoice_number',
        'purchaser_id',
        'order_date',
        'total',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'order_date' => 'date',
    ];

    /**
     * @return BelongsTo
     */
    public function purchaser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'purchaser_id');
    }

    /**
     * @return HasMany
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }


    /**
     * @return float|int
     */
    public function getPercentage(): float|int
    {
        $numberOfReferredDistributors = $this->getNumberOfReferredDistributors();
        if ($numberOfReferredDistributors >= 31) {
            $percentage = 30 / 100;
        } elseif ($numberOfReferredDistributors >= 21) {
            $percentage = 20 / 100;
        } elseif ($numberOfReferredDistributors >= 11) {
            $percentage = 15 / 100;
        } elseif ($numberOfReferredDistributors >= 5) {
            $percentage = 10 / 100;
        } else {
            $percentage = 5 / 100;
        }

        return $percentage;
    }

    /**
     * @return mixed
     */
    public function getNumberOfReferredDistributors(): mixed
    {
        $referredBy = $this->purchaser->referredBy;
        return $referredBy?->referredDistributors->count();
    }

    /**
     * @return mixed
     */
    public function getDistributor()
    {
        return $this->purchaser->referredBy;
    }

    public function getCommission(): float|int
    {
        return $this->getTotal() * $this->getPercentage();
    }

    public function getTotal(): float|int
    {
        $total = 0;
        foreach ($this->orderItems as $item) {
            $total += $item->product->price * $item->quantity;
        }

        return $total;
    }

}
