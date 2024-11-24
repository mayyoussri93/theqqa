<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FinancialInvoice extends Model
{
 protected $table="financial_invoice";
 protected $fillable=[
     'dafter_id',
     'site_id',
     'staff_id',
     'store_id',
     'type',
     'no',
     'client_id',
     'is_offline',
     'currency_code',
     'client_business_name',
     'client_country_code',
     'date',
     'payment_status',
     'draft',
     'issued',
     'active',
     'deposit',
     'deposit_type',
     'due_after',
     'issue_date',
     'date_format',
     'language_id',
     'summary_subtotal',
     'summary_discount',
     'summary_total',
     'summary_paid',
     'summary_unpaid',
     'summary_deposit',
     'notes',
     'html_notes',
     'created',
     'shipping_options',
     'extra_details',
     'branch_id',
     'requisition_delivery_status',
     'item_discount_amount',
     'group_price_id',
     'invoice_html_url',
     'invoice_pdf_url',
     'due_date',
 'dafter_id'];
    public $timestamps = false;

}

