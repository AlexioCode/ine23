<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    static function Offerings() {
        $sNow = date('Y-m-d H:i:s');
        return Product::where(DB::raw('date_format(discountStart_at,"%Y-%m-%d")'), '<=',
        date('Y-m-d', strtotime($sNow)))
        ->where('discountEnd_at', '>=', date('Y-m-d', strtotime($sNow))) ->get();
    }
    static function NewProducts() {
        $sNow = date('Y-m-d H:i:s');
        $sLastWeek = date('Y-m-d H:i:s', strtotime($sNow . ' - 1 week'));
        return Product::where(DB::raw('date_format(updated_at,"%Y-%m-%d")'),
         '<=', date('Y-m-d', strtotime($sNow)))
        ->where('updated_at', '>=', date('Y-m-d', strtotime($sLastWeek))) ->get();
    }
    public function HasDiscount() {
        $sNow = date('Y-m-d H:i:s');
        $sDiscountPercent = $this->discountPercent;
        $sProductStart = $this->discountStart_at;
        $sProductEnd = $this->discountEnd_at;
        // Check dates are not null, discount > 0, $sProductStart <= $sNow <= $sProductEnd
        return ($sProductStart != null && $sProductEnd != null && $sDiscountPercent > 0 && 
            $sProductStart <= $sNow && $sProductEnd >= $sNow);
    }
    public function Company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
