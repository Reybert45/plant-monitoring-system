<?php

Route::get('/', function () {
    return redirect()->intended(route('admin.login'));
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::prefix('user')->group(function () {
    Route::get('/logout', 'Auth\LoginController@userLogout')->name('user.logout');
    Route::get('/harvest/plant', 'HarvestPlantController@index');
    Route::post('/harvest/store', 'HarvestPlantController@store');
    Route::get('/harvest/plants_list', 'HarvestPlantController@plants_list');

    Route::get('watering_schedule', 'WateringScheduleController@index');
    Route::post('watering_schedule/store', 'WateringScheduleController@store');
    Route::post('watering_schedule/update', 'WateringScheduleController@update');
    Route::post('watering_schedule/delete', 'WateringScheduleController@delete');
    Route::post('watering_schedule/changeStatus', 'WateringScheduleController@changeStatus');
    Route::get('watering_schedule/data', 'WateringScheduleController@data');
    
    Route::get('my_profile', 'HomeController@my_profile');
    Route::post('my_profile/update', 'HomeController@update');
    Route::post('my_profile/changepass', 'HomeController@changepass');
    Route::post('my_profile/update_address', 'HomeController@update_address');

    Route::get('report', 'UserReportController@index');
    Route::get('report/data', 'UserReportController@data');
    Route::get('report/generateExcel', 'UserReportController@generateExcel');
    Route::get('report/generatePDF', 'UserReportController@generatePDF');

    Route::get('/plant_list/details', 'PlantMonitoringController@details');
    Route::get('/plant_list/fetch', 'PlantMonitoringController@fetch');

    Route::post('/plant-request/store', 'PlantRequestController@store');

    Route::get('/calendar', 'CalendarController@index');
});

Route::prefix('admin')->group(function () {
    Route::get('/index', 'AdminController@index')->name('admin.dashboard');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    // farms
        // plants
        Route::get('/plant_list', 'PlantController@index');
        Route::post('/plant_list/store', 'PlantController@store');
        Route::post('/plant_list/update', 'PlantController@update');
        Route::post('/plant_list/delete', 'PlantController@delete');
        Route::get('/plant_list/data', 'PlantController@data');
        Route::get('/plant_list/chart_data', 'PlantController@chart_data');

        // growing plants
        Route::get('/growing_plants', 'GrowingPlantController@index');
        Route::get('/growing_plants/data', 'GrowingPlantController@data');
        Route::get('/growing_plants/generatePDF', 'GrowingPlantController@generatePDF');
        Route::get('/growing_plants/generateExcel', 'GrowingPlantController@generateExcel');

        // harvested plants
        Route::get('/harvested_plants', 'HarvestedPlantsController@index');
        Route::get('/harvested_plants/data', 'HarvestedPlantsController@data');
        Route::get('/harvested_plants/generatePDF', 'HarvestedPlantsController@generatePDF');
        Route::get('/harvested_plants/generateExcel', 'HarvestedPlantsController@generateExcel');

        // fertilizers
        Route::get('/fertilizer_list', 'FertilizerController@index');
        Route::post('/fertilizer_list/store', 'FertilizerController@store');
        Route::post('/fertilizer_list/update', 'FertilizerController@update');
        Route::post('/fertilizer_list/delete', 'FertilizerController@delete');
        Route::get('/fertilizer_list/data', 'FertilizerController@data');

    // employee / admin components
        // gender
        Route::get('/gender', 'GenderController@index');
        Route::post('/gender/store', 'GenderController@store');
        Route::post('/gender/update', 'GenderController@update');
        Route::post('/gender/delete', 'GenderController@delete');
        Route::get('/gender/data', 'GenderController@data');
       
        // suffix
        Route::get('/suffix', 'SuffixController@index');
        Route::post('/suffix/store', 'SuffixController@store');
        Route::post('/suffix/update', 'SuffixController@update');
        Route::post('/suffix/delete', 'SuffixController@delete');
        Route::get('/suffix/data', 'SuffixController@data');
        
        // street
        Route::get('/street', 'StreetController@index');
        Route::post('/street/store', 'StreetController@store');
        Route::post('/street/update', 'StreetController@update');
        Route::post('/street/delete', 'StreetController@delete');
        Route::get('/street/data', 'StreetController@data');
       
        // barangay
        Route::get('/barangay', 'BarangayController@index');
        Route::post('/barangay/store', 'BarangayController@store');
        Route::post('/barangay/update', 'BarangayController@update');
        Route::post('/barangay/delete', 'BarangayController@delete');
        Route::get('/barangay/data', 'BarangayController@data');
        
        // barangay
        Route::get('/region', 'RegionController@index');
        Route::post('/region/store', 'RegionController@store');
        Route::post('/region/update', 'RegionController@update');
        Route::post('/region/delete', 'RegionController@delete');
        Route::get('/region/data', 'RegionController@data');
        
        // city
        Route::get('/city', 'CityController@index');
        Route::post('/city/store', 'CityController@store');
        Route::post('/city/update', 'CityController@update');
        Route::post('/city/delete', 'CityController@delete');
        Route::get('/city/data', 'CityController@data');
        
        // province
        Route::get('/province', 'ProvinceController@index');
        Route::post('/province/store', 'ProvinceController@store');
        Route::post('/province/update', 'ProvinceController@update');
        Route::post('/province/delete', 'ProvinceController@delete');
        Route::get('/province/data', 'ProvinceController@data');
       
        // zipcode
        Route::get('/zipcode', 'ZipCodeController@index');
        Route::post('/zipcode/store', 'ZipCodeController@store');
        Route::post('/zipcode/update', 'ZipCodeController@update');
        Route::post('/zipcode/delete', 'ZipCodeController@delete');
        Route::get('/zipcode/data', 'ZipCodeController@data');

    // user components
        // user
        Route::get('/user/manage', 'UserController@manage');
        Route::post('/user/store', 'UserController@store');
        Route::post('/user/update', 'UserController@update');
        Route::post('/user/delete', 'UserController@delete');
        Route::get('/user/data', 'UserController@data');
        
        // admin
        Route::get('/manage', 'AdminController@manage');
        Route::post('/store', 'AdminController@store');
        Route::post('/update', 'AdminController@update');
        Route::post('/delete', 'AdminController@delete');
        Route::get('/data', 'AdminController@data');

        // reports
        Route::get('report', 'ReportController@index');
        Route::get('report/data', 'ReportController@data');
        Route::get('report/generateExcel', 'ReportController@generateExcel');
        Route::get('report/generatePDF', 'ReportController@generatePDF');

        Route::get('/gardening-essential/index', 'GardeningEssentialController@index');
        Route::get('/gardening-essential/data', 'GardeningEssentialController@data');
        Route::post('/gardening-essential/store', 'GardeningEssentialController@store');
        Route::post('/gardening-essential/update', 'GardeningEssentialController@update');
        Route::post('/gardening-essential/delete', 'GardeningEssentialController@delete');

        Route::post('/plant-request/approve', 'PlantController@approve');
        Route::post('/plant-request/disapprove', 'PlantController@disapprove');
});
