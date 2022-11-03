<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class igms extends Model
{
    use HasFactory;
    protected $fillable = [
        'bill_of_landing_id', 'customs_office_code', 'igm_india_voyage_id', 'date_of_departure',
        'date_of_arrival', 'time_of_arrival', 'total_number_of_bols', 'total_number_of_packages',
        'total_number_of_containers',
        'total_gross_mass', 'consolidated_cargo', 'place_of_loading_code', 'place_of_unloading_code',
        'exporter_name', 'exporter_address', 'number_of_packages', 'package_type_code',
        'gross_mass', 'shipping_marks', 'volume_in_cubic_meters', 'num_of_ctn_for_this_bol',
        'mode_of_transport_code', 'identity_of_transporter', 'nationality_of_transporter_code',
        'slpa_ref_number', 'bol_reference', 'line_number', 'bol_nature', 'bol_type_code', 'place_of_departure_code',
        'place_of_destination_code', 'unique_carrier_reference', 'client_id_carrier',
        'client_id_notify', 'client_id_cosignee', 'freight_value', 'freight_currency', 'goods_description',
        'deleted'
    ];
}
