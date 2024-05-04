<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\DisplayProductController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\BrandProductController;
use App\Http\Controllers\SubBrandProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ModulController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UnproductiveReasonController;
use App\Http\Controllers\LogActivityController;
use App\Http\Controllers\GaleryFotoController;

use App\Http\Controllers\VisitController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     // return view('welcome');
//     return view('login');
// });
Route::get('login');
// Route::get('/', function(){
    
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('branch/trashed', [BranchController::class, 'trashed'])->name('branch.trashed');
    Route::get('branch/{id}/restore', [BranchController::class, 'restore'])->name('branch.restore');
    Route::delete('branch/{id}/force-delete', [BranchController::class, 'forceDelete'])->name('branch.force-delete');
    Route::resource('branch', BranchController::class);

    Route::get('position/trashed', [PositionController::class, 'trashed'])->name('position.trashed');
    Route::get('position/{id}/restore', [PositionController::class, 'restore'])->name('position.restore');
    Route::delete('position/{id}/force-delete', [PositionController::class, 'forceDelete'])->name('position.force-delete');
    Route::resource('position', PositionController::class);

    Route::get('display/trashed', [DisplayProductController::class, 'trashed'])->name('display.trashed');
    Route::get('display/{id}/restore', [DisplayProductController::class, 'restore'])->name('display.restore');
    Route::delete('display/{id}/force-delete', [DisplayProductController::class, 'forceDelete'])->name('display.force-delete');
    Route::get('display/autocomplete', [DisplayProductController::class, 'autocomplete'])->name('display.autocomplete');
    Route::resource('display', DisplayProductController::class);

    Route::get('category/trashed', [CategoryProductController::class, 'trashed'])->name('category.trashed');
    Route::get('category/{id}/restore', [CategoryProductController::class, 'restore'])->name('category.restore');
    Route::delete('category/{id}/force-delete', [CategoryProductController::class, 'forceDelete'])->name('category.force-delete');
    Route::get('category/autocomplete', [CategoryProductController::class, 'autocomplete'])->name('category.autocomplete');
    Route::resource('category', CategoryProductController::class);

    Route::get('brand/trashed', [BrandProductController::class, 'trashed'])->name('brand.trashed');
    Route::get('brand/{id}/restore', [BrandProductController::class, 'restore'])->name('brand.restore');
    Route::delete('brand/{id}/force-delete', [BrandProductController::class, 'forceDelete'])->name('brand.force-delete');
    Route::get('brand/autocomplete', [BrandProductController::class, 'autocomplete'])->name('brand.autocomplete');
    Route::resource('brand', BrandProductController::class);

    Route::get('sub-brand/trashed', [SubBrandProductController::class, 'trashed'])->name('sub-brand.trashed');
    Route::get('sub-brand/{id}/restore', [SubBrandProductController::class, 'restore'])->name('sub-brand.restore');
    Route::delete('sub-brand/{id}/force-delete', [SubBrandProductController::class, 'forceDelete'])->name('sub-brand.force-delete');
    Route::resource('sub-brand', SubBrandProductController::class);

    Route::get('product/trashed', [ProductController::class, 'trashed'])->name('product.trashed');
    Route::get('product/{id}/restore', [ProductController::class, 'restore'])->name('product.restore');
    Route::delete('product/{id}/force-delete', [ProductController::class, 'forceDelete'])->name('product.force-delete');
    Route::get('product/export', [ProductController::class, 'export'])->name('product.export');
    Route::post('product/import', [ProductController::class, 'import'])->name('product.import');
    Route::get('product/example-file-import/{file}', [ProductController::class, 'downloadFormatImport'])->name('product.file-import');
    Route::get('product/autocomplete', [ProductController::class, 'autocomplete'])->name('product.autocomplete');
    Route::resource('product', ProductController::class);

    Route::get('store/trashed', [StoreController::class, 'trashed'])->name('store.trashed');
    Route::get('store/{id}/restore', [StoreController::class, 'restore'])->name('store.restore');
    Route::delete('store/{id}/force-delete', [StoreController::class, 'forceDelete'])->name('store.force-delete');
    Route::get('store/export', [StoreController::class, 'export'])->name('store.export');
    Route::post('store/import', [StoreController::class, 'import'])->name('store.import');
    Route::get('store/example-file-import/{file}', [StoreController::class, 'downloadFormatImport'])->name('store.file-import');
    Route::get('store/autocomplete', [StoreController::class, 'autocomplete'])->name('store.autocomplete');
    Route::resource('store', StoreController::class);

    Route::get('outlet/trashed', [OutletController::class, 'trashed'])->name('outlet.trashed');
    Route::get('outlet/{id}/restore', [OutletController::class, 'restore'])->name('outlet.restore');
    Route::delete('outlet/{id}/force-delete', [OutletController::class, 'forceDelete'])->name('outlet.force-delete');
    Route::get('outlet/export', [OutletController::class, 'export'])->name('outlet.export');
    Route::post('outlet/import', [OutletController::class, 'import'])->name('outlet.import');
    Route::get('outlet/example-file-import/{file}', [OutletController::class, 'downloadFormatImport'])->name('outlet.file-import');
    Route::resource('outlet', OutletController::class);

    Route::get('user/trashed', [UserController::class, 'trashed'])->name('user.trashed');
    Route::get('user/{id}/restore', [UserController::class, 'restore'])->name('user.restore');
    Route::delete('user/{id}/force-delete', [UserController::class, 'forceDelete'])->name('user.force-delete');
    Route::resource('user', UserController::class);

    Route::resource('modul', ModulController::class);

    Route::resource('unproductive-reason', UnproductiveReasonController::class);

    Route::get('role/{id}/reset-permission', [RoleController::class, 'resetPermission'])->name('role.reset-permission');
    Route::resource('role', RoleController::class);

    Route::get('visit/{type}/list', [VisitController::class, 'list'])->name('visit.list');
    Route::get('visit/{type}/list/search', [VisitController::class, 'searchList'])->name('visit.search-list');
    Route::get('visit/{id}/create', [VisitController::class, 'create'])->name('visit.create');
    Route::post('visit/{id}/store', [VisitController::class, 'store'])->name('visit.store');
    Route::get('visit', [VisitController::class, 'SummaryVisit'])->name('visit.summary');
    Route::get('visit/search', [VisitController::class, 'SummaryVisitSearch'])->name('visit.summary-search');
    Route::get('visit/{date}/detail/{user}/daily', [VisitController::class, 'DailyVisit'])->name('visit.detail-daily');
    Route::get('visit/{date}/detail/{user}/store', [VisitController::class, 'DailyVisitStore'])->name('visit.detail-store-daily');
    Route::get('visit/{date}/detail/{user}/outlet', [VisitController::class, 'DailyVisitOutlet'])->name('visit.detail-outlet-daily');
    Route::get('visit/store/export', [VisitController::class, 'StoreExport'])->name('visit.store-export');
    Route::get('visit/outlet/export', [VisitController::class, 'OutletExport'])->name('visit.outlet-export');

    Route::get('log-activity', [LogActivityController::class, 'index'])->name('log-activity.index');

    Route::get('report-unproductive', [ReportController::class, 'UnproductiveReason'])->name('report-unproductive');
    Route::get('report-unproductive/export', [ReportController::class, 'ExportUnproductiveReason'])->name('report-unproductive.export');
    Route::get('report-gift', [ReportController::class, 'GiftingCustomer'])->name('report-gift');
    Route::get('report-gift/export', [ReportController::class, 'ExportGiftingCustomer'])->name('report-gift.export');

    Route::resource('galery', GaleryFotoController::class);
});

require __DIR__.'/auth.php';
