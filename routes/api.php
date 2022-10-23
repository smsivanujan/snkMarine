<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\CurrenciesController;
use App\Http\Controllers\PortsController;
use App\Http\Controllers\TimezonesController;
use App\Http\Controllers\TrafficmodesController;
use App\Http\Controllers\TypeofunitsController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\VendorsController;
use App\Http\Controllers\AccessmodelsController;
use App\Http\Controllers\AccesspointsController;
use App\Http\Controllers\ActivitylogsController;
use App\Http\Controllers\DefaultvaluesController;
use App\Http\Controllers\EquipmentsController;
use App\Http\Controllers\LoginlogsController;
use App\Http\Controllers\OwnersController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EquipmentsaledetailsController;
use App\Http\Controllers\EquipmentsalesController;
use App\Http\Controllers\SoasController;
use App\Http\Controllers\SoasubsController;
use App\Http\Controllers\SwaphistoriesController;
use App\Http\Controllers\SwapsController;
use App\Http\Controllers\IgmIndiaVoyagesController;
use App\Http\Controllers\BookingConfirmationsController;
use App\Http\Controllers\BillOfLandingSwitchesController;
use App\Http\Controllers\BillOfLandingNonInventoriesController;
use App\Http\Controllers\BillRemoteLogsController;
use App\Http\Controllers\BillOfLandingsController;
use App\Http\Controllers\ArrivalNoticiesController;
use App\Http\Controllers\DetentionInvoicesController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\VouchersController;
use App\Http\Controllers\ReceiptsController;
// ----------------------------------

use App\Http\Controllers\ArrivalNoticeChargesController;
use App\Http\Controllers\ArrivalNoticeContainersController;
use App\Http\Controllers\BillOfLandingSubNonInventoriesController;
use App\Http\Controllers\BillOfLandingSubNonInventoriesExpsController;
use App\Http\Controllers\BillOfLandingSubNonInventoriesImpsController;
use App\Http\Controllers\BillOfLandingSubsController;
use App\Http\Controllers\BillOfLandingSubsExpsController;
use App\Http\Controllers\BillOfLandingSubsImpsController;
use App\Http\Controllers\billoflandingswitchSubSwitchesController;
use App\Http\Controllers\BillOfLandingSubSwitchesExpsController;
use App\Http\Controllers\BillOfLandingSubSwitchesImpsController;
use App\Http\Controllers\DetentionInvoiceContainersController;
use App\Http\Controllers\DetentionInvoiceSlabsController;
use App\Http\Controllers\DetentionTraffiesController;
use App\Http\Controllers\DetentionTraffSubsController;
use App\Http\Controllers\InvoiceChargesController;
use App\Http\Controllers\ReceiptPaymentsController;
use App\Http\Controllers\RemoteBlController;
use App\Http\Controllers\VoucherPaymentsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//AccessPoints-----------------------------------------------OK-1---------------
Route::GET('/accesspoints/show/all', [AccesspointsController::class,'index']);
Route::POST('/accesspoints/store', [AccesspointsController::class,'store']);

//AccessModels-----------------------------------------------OK-1---------------
Route::GET('/accessmodels/show/all', [AccessmodelsController::class,'index']);
Route::POST('/accessmodels/store', [AccessmodelsController::class,'store']);

//ActivityLogs-----------------------------------------------OK-1---------------
Route::GET('/activitylogs/show/all', [ActivitylogsController::class,'index']);
Route::GET('/activitylogs/show/{id}', [ActivitylogsController::class,'showById']);
Route::POST('/activitylogs/store', [ActivitylogsController::class,'store']);

//Clients-----------------------------------------------OK-1---------------
Route::GET('/clients/show/all', [ClientsController::class,'index']);//ok
Route::GET('/clients/show/{id}', [ClientsController::class,'showById']);//ok
Route::POST('/clients/store', [ClientsController::class,'store']);//ok

//Countries-----------------------------------------------OK-1---------------
Route::GET('/countries/show/all', [CountriesController::class,'index']);//ok
Route::POST('/countries/store', [CountriesController::class,'store']);//ok

//Currencies-----------------------------------------------OK-1---------------
Route::GET('/currencies/show/all', [CurrenciesController::class,'index']);//ok
Route::GET('/currencies/show/{countryid}', [CurrenciesController::class,'showById']);//ok
Route::POST('/currencies/store', [CurrenciesController::class,'store']);//ok

//DefaultValues-----------------------------------------------OK-1---------------
Route::GET('/defaultvalues/show/all', [DefaultvaluesController::class,'index']);
Route::POST('/defaultvalues/store', [DefaultvaluesController::class,'store']);

//Departments-----------------------------------------------OK-1---------------
Route::GET('/departments/show/all', [DepartmentsController::class,'index']);//ok
Route::GET('/departments/show/{id}', [DepartmentsController::class,'showById']);//ok
Route::POST('/departments/store', [DepartmentsController::class,'store']);//ok

//Equipments-----------------------------------------------OK-1---------------
Route::GET('/equipments/show/all', [EquipmentsController::class,'index']);
Route::GET('/equipments/show/{id}', [EquipmentsController::class,'showById']);
Route::POST('/equipments/store', [EquipmentsController::class,'store']);

//LoginLogs-----------------------------------------------OK-1---------------
Route::GET('/loginlogs/show/all', [LoginlogsController::class,'index']);
Route::GET('/loginlogs/show/{id}', [LoginlogsController::class,'showById']);
Route::POST('/loginlogs/store', [LoginlogsController::class,'store']);

//Owners-----------------------------------------------OK-1---------------
Route::GET('/owners/show/all', [OwnersController::class,'index']);
Route::GET('/owners/show/{id}', [OwnersController::class,'showById']);
Route::POST('/owners/store', [OwnersController::class,'store']);

//Permissions-----------------------------------------------OK-1---------------
Route::GET('/permissions/show/all', [PermissionsController::class,'index']);
Route::GET('/permissions/show/{id}', [PermissionsController::class,'showById']);
Route::POST('/permissions/store', [PermissionsController::class,'store']);

//Ports-----------------------------------------------OK-1---------------
Route::GET('/ports/show/all', [PortsController::class,'index']);//ok
Route::GET('/ports/show/{countryid}', [PortsController::class,'showById']);
Route::POST('/ports/store', [PortsController::class,'store']);//ok

//Properties-----------------------------------------------OK-1---------------
Route::GET('/properties/show/all', [PropertiesController::class,'index']);//ok
Route::GET('/properties/show/{id}', [PropertiesController::class,'showById']);//ok
Route::POST('/properties/store', [PropertiesController::class,'store']);//ok

//Roles-----------------------------------------------OK-1---------------
Route::GET('/roles/show/all', [RolesController::class,'index']);//ok
Route::POST('/roles/store', [RolesController::class,'store']);//ok

//TimeZones-----------------------------------------------OK-1---------------
Route::GET('/timezones/show/all', [TimezonesController::class,'index']);
Route::POST('/timezones/store', [TimezonesController::class,'store']);

//TrafficModes-----------------------------------------------OK-1---------------
Route::GET('/trafficmodes/show/all', [TrafficmodesController::class,'index']);
Route::POST('/trafficmodes/store', [TrafficmodesController::class,'store']);

//TypeOfUnits-----------------------------------------------OK-1---------------
Route::GET('/typeofunits/show/all', [TypeofunitsController::class,'index']);
Route::POST('/typeofunits/store', [TypeofunitsController::class,'store']);

//Users-----------------------------------------------OK-1---------------
Route::GET('/users/show/all', [UsersController::class,'index']);//ok
Route::GET('/users/show/{id}', [UsersController::class,'showById']);//ok
Route::POST('/users/store', [UsersController::class,'store']);//ok

//Vendors-----------------------------------------------OK-1---------------
Route::GET('/vendors/show/all', [VendorsController::class,'index']);//ok
Route::GET('/vendors/show/{id}', [VendorsController::class,'showById']);//ok
Route::POST('/vendors/store', [VendorsController::class,'store']);//ok

//Soas-----------------------------------------------OK-1---------------
Route::GET('/soas/show/all', [SoasController::class,'index']);
Route::GET('/soas/show/{id}', [SoasController::class,'showById']);
Route::POST('/soas/store', [SoasController::class,'store']);

//Soa Subs -----------------------------------------------OK-1---------------
Route::GET('/soasubs/show/all', [SoasubsController::class,'index']);
Route::GET('/soasubs/show/{id}', [SoasubsController::class,'showById']);
Route::POST('/soasubs/store', [SoasubsController::class,'store']);

//Swap-----------------------------------------------OK-1---------------
Route::GET('/swaps/show/all', [SwapsController::class,'index']);
Route::GET('/swaps/show/{id}', [SwapsController::class,'showById']);
Route::POST('/swaps/store', [SwapsController::class,'store']);

//Swap Histories-----------------------------------------------OK-1---------------
Route::GET('/swaphistories/show/all', [SwaphistoriesController::class,'index']);
Route::GET('/swaphistories/show/{id}', [SwaphistoriesController::class,'showById']);
Route::POST('/swaphistories/store', [SwaphistoriesController::class,'store']);

//Equipment Sales-----------------------------------------------OK-1---------------
Route::GET('/equipmentsales/show/all', [EquipmentsalesController::class,'index']);
Route::GET('/equipmentsales/show/{id}', [EquipmentsalesController::class,'showById']);
Route::POST('/equipmentsales/store', [EquipmentsalesController::class,'store']);

//Equipment Sale Details-----------------------------------------------OK-1 ---------------
Route::GET('/equipmentsaledetails/show/all', [EquipmentsaledetailsController::class,'index']);
Route::GET('/equipmentsaledetails/show/{id}', [EquipmentsaledetailsController::class,'showById']);
Route::POST('/equipmentsaledetails/store', [EquipmentsaledetailsController::class,'store']);

//Igm India Voyage--------------------------------------------------------------
Route::GET('/igmindiavoyage/show/all', [IgmIndiaVoyagesController::class,'index']);
Route::GET('/igmindiavoyage/show/{id}', [IgmIndiaVoyagesController::class,'showById']);
Route::POST('/igmindiavoyage/store', [IgmIndiaVoyagesController::class,'store']);

//Booking Confirmations--------------------------------------------------------------
Route::GET('/bookingconfirmations/show/all', [BookingConfirmationsController::class,'index']);
Route::GET('/bookingconfirmations/show/{id}', [BookingConfirmationsController::class,'showById']);
Route::POST('/bookingconfirmations/store', [BookingConfirmationsController::class,'store']);

//Bill Of Landings--------------------------------------------------------------
Route::GET('/billoflandings/show/all', [BillOfLandingSwitchesController::class,'index']);
Route::GET('/billoflandings/show/{id}', [BillOfLandingSwitchesController::class,'showById']);
Route::POST('/billoflandings/store', [BillOfLandingSwitchesController::class,'store']);

//Bill Remote Logs--------------------------------------------------------------
Route::GET('/billremotelogs/show/all', [BillOfLandingNonInventoriesController::class,'index']);
Route::GET('/billremotelogs/show/{id}', [BillOfLandingNonInventoriesController::class,'showById']);
Route::POST('/billremotelogs/store', [BillOfLandingNonInventoriesController::class,'store']);

//Bill Of Landing Non Inventory--------------------------------------------------------------
Route::GET('/billoflandingsnoninventory/show/all', [BillRemoteLogsController::class,'index']);
Route::GET('/billoflandingsnoninventory/show/{id}', [BillRemoteLogsController::class,'showById']);
Route::POST('/billoflandingsnoninventory/store', [BillRemoteLogsController::class,'store']);

//Bill Of Landing Switches--------------------------------------------------------------
Route::GET('/billoflandingswitches/show/all', [BillOfLandingsController::class,'index']);
Route::GET('/billoflandingswitches/show/{id}', [BillOfLandingsController::class,'showById']);
Route::POST('/billoflandingswitches/store', [BillOfLandingsController::class,'store']);

//Arival Notices--------------------------------------------------------------
Route::GET('/arivalnotices/show/all', [ArrivalNoticiesController::class,'index']);
Route::GET('/arivalnotices/show/{id}', [ArrivalNoticiesController::class,'showById']);
Route::POST('/arivalnotices/store', [ArrivalNoticiesController::class,'store']);

//Detention Invoices-----------------------------------------------O---------------
Route::GET('/detentioninvoice/show/all', [DetentionInvoicesController::class,'index']);
Route::GET('/detentioninvoice/show/{id}', [DetentionInvoicesController::class,'showById']);
Route::POST('/detentioninvoice/store', [DetentionInvoicesController::class,'store']);

//Invoicess-----------------------------------------------O---------------
Route::GET('/invoices/show/all', [InvoicesController::class,'index']);
Route::GET('/invoices/show/{id}', [InvoicesController::class,'showById']);
Route::POST('/invoices/store', [InvoicesController::class,'store']);

//Voucherss-----------------------------------------------O---------------
Route::GET('/vouchers/show/all', [VouchersController::class,'index']);
Route::GET('/vouchers/show/{id}', [VouchersController::class,'showById']);
Route::POST('/vouchers/store', [VouchersController::class,'store']);

//Receipts-----------------------------------------------O---------------
Route::GET('/receipts/show/all', [ReceiptsController::class,'index']);
Route::GET('/receipts/show/{id}', [ReceiptsController::class,'showById']);
Route::POST('/receipts/store', [ReceiptsController::class,'store']);

// ------------------------------