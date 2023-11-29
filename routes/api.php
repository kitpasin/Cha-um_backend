<?php

namespace App\Http\Controllers\backoffice;

use App\Http\Controllers\frontoffice\ContactsController;
use App\Http\Controllers\frontoffice\DesignsController;
use App\Http\Controllers\frontoffice\FooterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontoffice\NavbarController;
use App\Http\Controllers\frontoffice\HomeController;
use App\Http\Controllers\frontoffice\PortfoliosController;
use App\Http\Controllers\frontoffice\ProcessesController;
use App\Http\Controllers\frontoffice\ProductsController;
use App\Http\Controllers\frontoffice\ServicesController;
use App\Http\Controllers\frontoffice\WebInfosController;

Route::prefix('backoffice/v1')->group(function () {

    Route::post('login', [AuthBackOfficeController::class, 'loginAccount']);
    Route::post('register', [AuthBackOfficeController::class, 'registerAccount']);
    Route::post('forget-password', [AuthBackOfficeController::class, 'onSubmitForgetPassword']);
    Route::post('reset-password', [AuthBackOfficeController::class, 'onResetPassword']);

    // Frontoffice
    // WebInfo
    Route::get('webinfo/read', [WebInfosController::class, 'readWebInfo']);
    // Navbar
    Route::get('categories/read', [NavbarController::class, 'readCategories']);
    // Footer
    Route::get('footer/read', [FooterController::class, 'readFooter']);
    // Home
    Route::get('home/read', [HomeController::class, 'readHome']);
    // Product
    Route::get('product/read', [ProductsController::class, 'readProduct']);
    Route::get('product/detail/read/{id}', [ProductsController::class, 'readProductDetail']);
    Route::post('product/category/read', [ProductsController::class, 'readProductByCategory']);
    // Portfolio
    Route::get('portfolio/read', [PortfoliosController::class, 'readPortfolio']);
    Route::get('portfolio/detail/read/{id}', [PortfoliosController::class, 'readPortfolioDetail']);
    // Service
    Route::get('service/read', [ServicesController::class, 'readService']);
    Route::get('service/detail/read/{id}', [ServicesController::class, 'readServiceDetail']);
    Route::post('service/category/read', [ServicesController::class, 'readServiceByCategory']);
    // Process
    Route::get('process/read', [ProcessesController::class, 'readProcess']);
    Route::post('process/category/read', [ProcessesController::class, 'readProcessByCategory']);
    // Design
    Route::get('design/read', [DesignsController::class, 'readDesign']);
    Route::get('design/detail/read/{id}', [DesignsController::class, 'readDesignDetail']);
    // Contact
    Route::post('message/create', [MessageController::class, 'createMessage']);
    Route::get('contact/read', [ContactsController::class, 'readContactBanner']);
    
    // Backoffice
    Route::middleware('auth:api')->group(function () {
        Route::post('account/settings', [AuthBackOfficeController::class, 'getAccountSettings']);
        Route::post('account/token/invoke/current', [AuthBackOfficeController::class, 'revokeCurrentToken']);
        Route::post('account/token/invoke/token_id', [AuthBackOfficeController::class, 'revokeTokenByID']);
        Route::post('account/token/invoke/all', [AuthBackOfficeController::class, 'revokeAllToken']);

        /* Infomation Page */
        Route::get('webinfo/data', [WebInfoController::class, 'index']);
        Route::post('webinfo/details', [WebInfoController::class, 'updateWebDetails']);
        Route::delete('webinfo/image/{language}/{position}', [WebInfoController::class, 'deleteImage']);
        Route::post('webinfo/create', [WebInfoController::class, 'createWebInfo']);
        Route::post('webinfo/token/{token}', [WebInfoController::class, 'addWebInfo']);
        Route::patch('webinfo/token/{token}', [WebInfoController::class, 'editWebInfo']);
        Route::patch('webinfo/display/toggle', [WebInfoController::class, 'toggleDisplayByToken']);
        Route::delete('webinfo/{language}/{token}', [WebInfoController::class, 'deleteWebInfoByInfoId']);

        /* Category Page */
        Route::get('category/data', [CategoryController::class, 'index']);
        Route::post('category/create', [CategoryController::class, 'createCategory']);
        Route::post('category/update/{id}', [CategoryController::class, 'updateCategory']);
        Route::delete('category/{language}/{token}', [CategoryController::class, 'deleteCategory']);
        Route::get('category/menu', [CategoryController::class, 'getCateMenu']);

        /* Sub Category Page */
        Route::post('subcategory/create', [SubCategoryController::class, 'createSubCategory']);
        Route::post('subcategory/update/{id}', [SubCategoryController::class, 'updateSubCategory']);
        Route::delete('subcategory/{language}/{token}', [SubCategoryController::class, 'deleteSubCategory']);
        Route::get('subcategory/menu', [SubCategoryController::class, 'getSubCateMenu']);
        /* Product Page */
        Route::get('product/data', [ProductController::class, 'index']);
        Route::post('product/create', [ProductController::class, 'createProduct']);
        Route::post('product/update/{id}', [ProductController::class, 'updateProduct']);
        Route::delete('product/{language}/{token}', [ProductController::class, 'deleteProduct']);

        /* Service Page */
        Route::get('service/data', [ServiceController::class, 'index']);
        Route::post('service/create', [ServiceController::class, 'createService']);
        Route::post('service/update/{id}', [ServiceController::class, 'updateService']);
        Route::delete('service/{language}/{token}', [ServiceController::class, 'deleteService']);

        /* Portfolio Page */
        Route::get('portfolio/data', [PortfolioController::class, 'index']);
        Route::post('portfolio/create', [PortfolioController::class, 'createPortfolio']);
        Route::post('portfolio/update/{id}', [PortfolioController::class, 'updatePortfolio']);
        Route::delete('portfolio/{language}/{token}', [PortfolioController::class, 'deletePortfolio']);

        /* Design Page */
        Route::get('design/data', [DesignController::class, 'index']);
        Route::post('design/create', [DesignController::class, 'createDesign']);
        Route::post('design/update/{id}', [DesignController::class, 'updateDesign']);
        Route::delete('design/{language}/{token}', [DesignController::class, 'deleteDesign']);

        /* Content Page */
        Route::get('content/data', [PostController::class, 'index']);
        Route::post('content/create', [PostController::class, 'createContent']);
        Route::post('content/update/{id}', [PostController::class, 'updateContent']);
        Route::delete('content/{language}/{token}', [PostController::class, 'deleteContent']);

        /* Contact Page */
        Route::get('message/data', [MessageController::class, 'index']);
        Route::post('message/update/{id}', [MessageController::class, 'updateMessage']);
        Route::delete('message/delete/{id}', [MessageController::class, 'deleteMessage']);

        /* Admin Page */
        Route::get('admin/data', [AdminController::class, 'index']);
        Route::post('admin/edit', [AdminController::class, 'editAdminAccount']);
        Route::delete('admin/{language}/{token}', [AdminController::class, 'deleteAdminAccount']);

        /* Language Config Page */
        Route::get('language/data', [LanguageConfigController::class, 'index']);
        Route::post('language/create', [LanguageConfigController::class, 'createLanguage']);
        Route::patch('language/edit', [LanguageConfigController::class, 'editLanguage']);
        Route::delete('language/delete/{param}', [LanguageConfigController::class, 'deleteLanguage']);

        /* Configuaration Page */
        Route::get('config/data', [ConfigController::class, 'index']);
        Route::delete('config/language/token/{token}', [ConfigController::class, 'deleteConfigLanguage']);
        Route::post('config/language/create', [ConfigController::class, 'createLanguage']);
        Route::post('config/data_type/create', [ConfigController::class, 'createDataType']);
        Route::delete('config/data_type/token/{token}', [ConfigController::class, 'deleteConfigDataType']);
        Route::post('config/ad_type/create', [ConfigController::class, 'createAdType']);
        Route::patch('config/ad_type/edit', [ConfigController::class, 'editAdType']);
        Route::delete('config/ad_type/token/{token}', [ConfigController::class, 'deleteConfigAdType']);

        Route::post('config/upload/manual', [ConfigController::class, 'uploadManual']);


        /* Utility */
        Route::post('ckeditor/upload/image', [UtilController::class, 'ckeditorUploadImage']);
    });
});
