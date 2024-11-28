<?php
use App\Http\Controllers\Renting\RentContractController;
use App\Http\Controllers\Renting\RentController;
use App\Http\Controllers\Admin\ContractManagement\AccreditationContractController;
use App\Http\Controllers\Admin\ContractManagement\ArrivedContractController;
use App\Http\Controllers\Admin\ContractManagement\ContractController;
use App\Http\Controllers\Admin\ContractManagement\ContractSourceController;
use App\Http\Controllers\Admin\ContractManagement\CoveredGuaranteeContractController;
use App\Http\Controllers\Admin\ContractManagement\ElectricAuthContractController;
use App\Http\Controllers\Admin\ContractManagement\MusandContractController;
use App\Http\Controllers\Admin\ContractManagement\NewContractController;
use App\Http\Controllers\Admin\ContractManagement\ThrowbackContractController;
use App\Http\Controllers\Admin\ContractManagement\TicketContractController;
use App\Http\Controllers\Admin\ContractManagement\VisaContractController;
use App\Http\Controllers\Admin\CustomerManagement\CentralBulkUploadController;
use App\Http\Controllers\Admin\CustomerManagement\ClientOutController;
use App\Http\Controllers\Admin\CustomerManagement\ContactUsController;
use App\Http\Controllers\Admin\CustomerManagement\CustomerBulkUploadController;
use App\Http\Controllers\Admin\CustomerManagement\CustomerController;
use App\Http\Controllers\Admin\CustomerManagement\FollowUpController;
use App\Http\Controllers\Admin\CustomerManagement\SubscriberController;
use App\Http\Controllers\Admin\CvManagement\AirportController;
use App\Http\Controllers\Admin\CvManagement\BookingStatusController;
use App\Http\Controllers\Admin\CvManagement\CityController;
use App\Http\Controllers\Admin\CvManagement\CountryController;
use App\Http\Controllers\Admin\CvManagement\CVController;
use App\Http\Controllers\Admin\CvManagement\NationalityController;
use App\Http\Controllers\Admin\CvManagement\RecruitmentAccommodationTypeController;
use App\Http\Controllers\Admin\CvManagement\RecruitmentFormAgeController;
use App\Http\Controllers\Admin\CvManagement\RecruitmentFormExperienceController;
use App\Http\Controllers\Admin\CvManagement\RecruitmentFormLanguageController;
use App\Http\Controllers\Admin\CvManagement\RecruitmentFormOccupationController;
use App\Http\Controllers\Admin\CvManagement\RecruitmentFormReligionController;
use App\Http\Controllers\Admin\CvManagement\RecruitmentFormSocialStatusController;
use App\Http\Controllers\Admin\FinancialManagement\ConcessionController;
use App\Http\Controllers\Admin\FinancialManagement\ExternalRequestController;
use App\Http\Controllers\Admin\FinancialManagement\FinancialRequestController;
use App\Http\Controllers\Admin\FinancialManagement\InvoicesController;
use App\Http\Controllers\Admin\LodgingManagement\CVPreviousSponsorController;
use App\Http\Controllers\Admin\LodgingManagement\DurationWorkSponsorController;
use App\Http\Controllers\Admin\LodgingManagement\LodgingController;
use App\Http\Controllers\Admin\LodgingManagement\NoteController;
use App\Http\Controllers\Admin\ContractManagement\NoteContractController;
use App\Http\Controllers\Admin\LodgingManagement\OrderCVPreviousSponsorController;
use App\Http\Controllers\Admin\LodgingManagement\ReasonforwaiverController;
use App\Http\Controllers\Admin\LodgingManagement\SalaryStatusController;
use App\Http\Controllers\Admin\OfficeManagement\OfficeController;
use App\Http\Controllers\Admin\OfficeManagement\OfficeProfileController;
use App\Http\Controllers\Admin\RecruitmentManagement\BookingCvController;
use App\Http\Controllers\Admin\RecruitmentManagement\RecruitmentFormController;
use App\Http\Controllers\Admin\SupportTicketManagement\SupportTicketController;
use App\Http\Controllers\Admin\SettingManagement\NotificationController;
use App\Http\Controllers\Admin\CvManagement\SkillController;
use App\Http\Controllers\Admin\SettingManagement\HomeController;
use App\Http\Controllers\Admin\SettingManagement\AizUploadController;
use App\Http\Controllers\Admin\SettingManagement\UserController;
use App\Http\Controllers\Admin\SettingManagement\RecruitmentStepController;
use App\Http\Controllers\Admin\SettingManagement\RecruitmentReferenceController;
use App\Http\Controllers\Admin\SettingManagement\RecruitmentRequirementController;
use App\Http\Controllers\Admin\SettingManagement\RecruitmentRequirementDetailController;
use App\Http\Controllers\Admin\SettingManagement\NewsletterController;
use App\Http\Controllers\Admin\SettingManagement\ServiceController;
use App\Http\Controllers\Admin\SettingManagement\PolicyRecruitmentController;
use App\Http\Controllers\Admin\SettingManagement\MusanedController;
use App\Http\Controllers\Admin\SettingManagement\BlogController;
use App\Http\Controllers\Admin\SettingManagement\BusinessSettingsController;
use App\Http\Controllers\Admin\SettingManagement\LanguageController;
use App\Http\Controllers\Admin\SettingManagement\RoleController;
use App\Http\Controllers\Admin\SettingManagement\StaffController;
use App\Http\Controllers\Admin\SettingManagement\RecruitmentClientController;
use App\Http\Controllers\Admin\SettingManagement\JobController;
use App\Http\Controllers\Admin\SettingManagement\TrainingController;
use App\Http\Controllers\Admin\SettingManagement\VisaController;
use App\Http\Controllers\Admin\SettingManagement\CommonTopicController;
use App\Http\Controllers\Admin\SettingManagement\ReadCommonTopicController;
use App\Http\Controllers\Admin\SettingManagement\SeoController;
use App\Http\Controllers\Admin\SettingManagement\ProfileController;
use App\Http\Controllers\Admin\SettingManagement\RecruitmentContractController;
use App\Http\Controllers\Admin\SettingManagement\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ReportManagement\ContractReportController;
use App\Http\Controllers\Admin\ReportManagement\LodgingReportController;
use App\Http\Controllers\Admin\ReportManagement\CvReportController;
/*
  |--------------------------------------------------------------------------
  | Admin Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register admin routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin','unbanned']], function ($router) {
    /*==================== التقارير  ==================*/

    Route::controller(ContractReportController::class)
        ->group(function ($router) {
            Route::get('contract_report_filter', 'ContractReportFilter')->name('report.contract_filter');
//            Route::get('contract_report_filter_view', 'ContractReportFilterView')->name('report.contract_filter_view');
            Route::post('contract_report_result', 'ContractReportResult')->name('report.contract_result');

        });
    Route::controller(LodgingReportController::class)
        ->group(function ($router) {
            Route::get('Lodging_report_filter', 'LodgingReportFilter')->name('report.lodging_filter');
            Route::post('Lodging_report_result', 'LodgingReportResult')->name('report.lodging_result');

        });
    Route::controller(CvReportController::class)
        ->group(function ($router) {
            Route::get('Cv_report_filter', 'CvReportFilter')->name('report.cv_filter');
            Route::post('Cv_report_result', 'CvReportResult')->name('report.cv_result');

        });
    /*=================================================*/

    /*==================== الايواء  ==================*/

    Route::controller(LodgingController::class)
     ->group(function ($router) {
            Route::get('lodging_contract_create', 'contractCreate')->name('lodging.contract_create');
            Route::post('get_lodging_contract_data', 'getLodgingContractData')->name('get_lodging_contract_data');
            Route::post('lodging_contract_store', 'contractstore')->name('lodging.contract_store');
            Route::get('lodging/download/{contract_id}', 'LodgingDownload')->name('lodging.download');
            Route::get('lodging/print/{data}', 'LodgingPrintDownload')->name('lodging.print');
            Route::post('housing_official_action', 'housingOfficialAction')->name('housing_official_action');
            Route::post('service_action', 'serviceAction')->name('service_action');
            Route::get('lodging_not_work_index', 'index')->name('lodging_not_work_index');
            Route::get('/lodging_not_work_index/destroy/{id}', 'destroy')->name('lodging_not_work_index.destroy');
            Route::post('change_lodging_type', 'change_lodging_type')->name('change_lodging_type');
            Route::get('lodging_return_work_index', 'lodging_return_work_index')->name('lodging_return_work_index');
            Route::get('lodging_deporation', 'index_deporation')->name('lodging_deporation_index');
            Route::post('worker_deported', 'worker_deported')->name('worker_deported');
        });
    Route::controller(CVPreviousSponsorController::class)
        ->group(function ($router) {
            Route::get('/cvs_hosting','index_hosting')->name('cv_previous_sponsor.index_hosting.index');
            Route::get('/cv_previous_sponsor/destroy/{id}', 'destroy')->name('cv_previous_sponsor.destroy');
            Route::get('/cv_previous_sponsor/change/apear/{id}', 'changeBookingAvaliable')->name('cv_previous_sponsor.change.apear');
            Route::get('/cv_previous_sponsor/change/notapear/{id}', 'changeBookingNotAvaliable')->name('cv_previous_sponsor.change.notapear');
            Route::get('/cv_previous_sponsor/edit/{id}', 'edit')->name('CVPreviousSponsorController.edit');
            Route::post('/transfer_guarantee_contract', 'transfer_guarantee_contract')->name('transfer_guarantee_contract');
            Route::post('/transfer_guarantee_contract_update/{id}', 'update')->name('transfer_guarantee_contract.update');
            Route::get('lodging_probation_index', 'lodging_probation_index')->name('lodging_probation');
            Route::get('/contracts_transferred', 'contracts_transferred')->name('contracts_transferred');
            Route::get('/contracts_transferred_requested', 'contracts_transferred_requested')->name('contracts_transferred_requested');
            Route::post('/action_transfered/change/', 'action_transfered')->name('action_transfered');
            Route::post('/action_transfered/delete/', 'delete_transfered')->name('delete_transfered');
            Route::get('/cv_previous_sponsor/delete/list', 'delete_transfered_list')->name('delete_transfered_list');
            Route::post('/cv_previous_sponsor/front/add', 'add_cv_previous_sponsor')->name('add_cv_previous_sponsor');
            Route::post('/get_contract_value', 'get_contract_value')->name('get_contract_value');
            Route::post('/don_want_work_change', 'don_want_work_change')->name('don_want_work_change');
            Route::post('/ads_pic_add/{id}', 'transfere_pic_add')->name('transfere_pic_add');
            Route::get('/transfer_form/{id}', 'transferPdfGenerate')
                ->name('transfer_form');
            Route::get('/failure/experiment/{id}', 'failureExperiment')->name('failure_experiment');


//            Route::get('/transfer/{id}', function (){
//                return view('backend.LodgingManagement.transfer_form');
//            })
//                ->name('transfer_form');

        });
    Route::controller(ReasonforwaiverController::class)
        ->group(function ($router) {
            Route::get('/reason_for_waiver/edit/{id}', 'edit')->name('reason_for_waiver.edit');
            Route::get('/reason_for_waiver/destroy/{id}', 'destroy')->name('reason_for_waiver.destroy');
        });
    Route::controller(SalaryStatusController::class)
        ->group(function ($router) {
            Route::get('/salary_status/edit/{id}', 'edit')->name('salary_status.edit');
            Route::get('/salary_status/destroy/{id}', 'destroy')->name('salary_status.destroy');
        });
    Route::controller(DurationWorkSponsorController::class)
        ->group(function ($router) {
            Route::get('/duration_work_sponsor/edit/{id}', 'edit')->name('duration_work_sponsor.edit');
            Route::get('/duration_work_sponsor/destroy/{id}', 'destroy')->name('duration_work_sponsor.destroy');
        });
    Route::controller(NoteController::class)
        ->group(function ($router) {
            Route::get('/lodging_notes/edit/{id}', 'edit')->name('lodging_notes.edit');
            Route::get('/lodging_notes/destroy/{id}', 'destroy')->name('lodging_notes.destroy');
        });
    Route::resource('lodging',LodgingController::class,['except' => ['destroy']]);
    Route::resource('cv_previous_sponsor',CVPreviousSponsorController::class,['except' => ['destroy']]);
    Route::resource('order_cvPrevious_sponsor', OrderCVPreviousSponsorController::class,['except' => ['destroy']]);
    Route::resource('reason_for_waiver',ReasonforwaiverController::class,['except' => ['destroy']]);
    Route::resource('salary_status',SalaryStatusController::class,['except' => ['destroy']]);
    Route::resource('duration_work_sponsor',DurationWorkSponsorController::class,['except' => ['destroy']]);
    Route::resource('lodging_notes',NoteController::class,['except' => ['destroy']]);

    /*===============================================*/
    /*==================== التأجير  ==================*/
    Route::resource('rentContract', RentContractController::class);
    Route::controller(RentContractController::class)
        ->group(function ($router) {
            Route::get('/rentContract/delete/{id}', 'destroy')->name('rentContract.destroy');
            Route::get('/rentService/close_contract/{id}', 'closeContract')->name('rentContract.close');
            Route::get('/rentService/open_contract/{id}', 'openContract')->name('rentContract.open');
            Route::get('contract_delivery_form/download/{contract_id}', 'deliveryFormDownload')->name('rent_contract_delivery_form.download');
            Route::post('/change/rentContract/add', 'changeAdminCV')->name('change.rentContract');
            Route::get('rentContract/export/',  'export')->name('rentContract_export');

        });

    Route::controller(RentController::class)
        ->group(function ($router) {
            Route::get('/rentService', 'index')->name('rentService');
            Route::get('/rentService/destroy/{id}', 'destroy')->name('rent.destroy');
        });

    Route::get('/contract_delivery_form', function (){
        return view('backend.RentManagement.delivery_form');
    });

    /*===============================================*/
    /*==================== ادارة المالية  ==================*/
    Route::controller(FinancialRequestController::class)
        ->group(function ($router) {
            Route::post('/financial_request/change/status', 'changeStatus')->name('financial_request.change.status');
            Route::post('/financial_request/add/notes', 'addNotes')->name('financial_request.add.notes');
            Route::post('/financial_request/add/mark', 'addMark')->name('financial_request.add.mark');
            Route::post('store_note', 'store_note')->name('financial_request.store_note');
            Route::get('/financial_request/destroy/{id}', 'destroy')->name('financial_request.destroy');
            Route::get('/financial_request/notes/{id}', 'getNotes')->name('financial_request.getNotes');
            Route::post('/financial_request/pending/{id}', 'pend')->name('financial_request.pend');

        });
    Route::controller(ExternalRequestController::class)
        ->group(function ($router) {
            Route::get('/external_request_type/create', 'createType')->name('ExternalRequestType.create');
            Route::post('/external_request_type/store', 'storeType')->name('external_request_type.store');
            Route::get('/external_requests_types', 'typeIndex')->name('external_request_type.index');
            Route::get('/external_request/create', 'createRequest')->name('external_request.create');
            Route::post('/external_request/store', 'storeRequest')->name('external_request.store');
            Route::get('/external_request/show/{id}', 'showRequest')->name('external_request.show');
            Route::get('/external_requests', 'requestIndex')->name('external_request.index');
            Route::get('/external_requests/edit/{id}', 'editRequest')->name('external_request.edit');
            Route::patch('/external_request/update/{id}', 'update')->name('external_request.update');
            Route::get('/external_requests/delete/{id}', 'requestDelete')->name('external_request.destroy');
            Route::post('/external_request/change/status', 'changeStatus')->name('external_request.change.status');
            Route::post('/external_request/add/notes', 'addNotes')->name('external_request.add.notes');
            Route::post('/external_request/store_note', 'store_note')->name('external_request.store_note');
            Route::get('/external_request/notes/{id}', 'getNotes')->name('external_request.getNotes');
            Route::post('/external_request/pending/{id}', 'pend')->name('external_request.pend');
            Route::post('/external_request/change_department/{id}', 'changeDepartment')->name('external_request.changeDepartment');
            Route::post('/external_request/add/mark', 'addMark')->name('external_request.add.mark');

        });
    Route::controller(ConcessionController::class)
        ->group(function ($router) {
            Route::get('/Concessions/create', 'create')->name('concessions.create');
            Route::post('/Concessions/store', 'store')->name('concessions.store');
        });
    Route::resource('financial_request', FinancialRequestController::class,['except' => ['destroy']]);
    Route::resource('invoices', InvoicesController::class,['except' => ['destroy']]);
    Route::get('/get_invoices_data',[InvoicesController::class, 'getInvoicesData'])->name('get_invoices_data');

    /*===============================================*/
    /*==================== السيرة الذاتية  ==================*/
    Route::controller(CVController::class)
        ->group(function ($router) {
            Route::post('/cvs/change/booking', 'changeBooking')->name('cv.change.booking');
            Route::get('/cvs/download/booking/{id}', 'cvsDownload')->name('cvs_download.view');
            Route::get('/cvs/views/{id}', 'cvs_view')->name('cvs_view');
            Route::post('cvs/backout', 'backout')->name('cvs.backout');
            Route::post('cvs/remove_backout', 'remove_backout')->name('cvs.remove_backout');
            Route::post('cvs/remove_deledted', 'remove_deledted')->name('cvs.remove_deledted');
            Route::post('office_profile', 'fetchOfficeProfile')->name('cvs.office_profile');
            Route::post('get_profile', 'getProfile')->name('cvs.get_profile');
            Route::post('/cvs/destroy', 'destroy')->name('cvs.destroy');
            Route::get('/cvs_back_out', 'index_back_out')->name('index_back_out.index');
            Route::get('/cvs_deleted', 'index_cv_deleted')->name('index_cv_deleted.index');
            Route::post('/cvs/pandding', 'changePanddingStatus')->name('cv.change.pandding');
            Route::get('/cvs/pandding/status', 'changePanddingStatusId')->name('cv.id.change.pandding');
            Route::get('/cvs/marking/{id}', 'mark_biographies')->name('cv.marking');
            Route::get('/cvs/unmarking/{id}', 'unmark_biographies')->name('cv.unmarking');

            Route::get('rapid_cv_add', 'rapid_cv_add')->name('rapid_cv_add');
            Route::get('resizeImagePost/{id}', 'resizeImagePost')->name('resizeImagePost');
            Route::get('resizeImageSponsorPost/{id}', 'resizeImageSponsorPost')->name('resizeImageSponsorPost');
            Route::post('/bulk-cv-upload', 'cv_bulk_upload')->name('bulk_cv_upload');
            Route::post('/bulk-cv-upload', 'cv_bulk_upload')->name('bulk_cv_upload');
            Route::get('cv/export/', 'export')->name('cv_export');
            Route::post('/cvs_file_add/{id}', 'addCvFile')->name('cv.cvs_file_add');
            Route::get('/download/{id}', 'download')->name('cv.download');

        });


    Route::resource('skills', SkillController::class,['except' => ['destroy']]);
    Route::get('/skills/destroy/{id}', [SkillController::class,'destroy'])->name('skills.destroy');
    Route::resource('cvs', CVController::class,['except' => ['destroy']]);
    Route::resource('airports', AirportController::class,['except' => ['destroy']]);
    Route::resource('recruitment_form_experiences', RecruitmentFormExperienceController::class,['except' => ['destroy']]);
    Route::resource('recruitment_form_languages', RecruitmentFormLanguageController::class,['except' => ['destroy']]);
    Route::get('airports/destroy', [AirportController::class,'destroy'])->name('airports.destroy');


    Route::controller(RecruitmentFormExperienceController::class)
        ->group(function ($router) {
            Route::get('/recruitment_form_experiences/edit/{id}', 'edit')->name('recruitment_form_experiences.edit');
            Route::get('/recruitment_form_experiences/destroy/{id}', 'destroy')->name('recruitment_form_experiences.destroy');
        });

    Route::controller(RecruitmentFormLanguageController::class)
        ->group(function ($router) {
            Route::get('/recruitment_form_languages/edit/{id}', 'edit')->name('recruitment_form_languages.edit');
            Route::get('/recruitment_form_languages/destroy/{id}', 'destroy')->name('recruitment_form_languages.destroy');
        });

    Route::controller(RecruitmentFormAgeController::class)
        ->group(function ($router) {
            Route::get('/recruitment_form_ages/edit/{id}', 'edit')->name('recruitment_form_ages.edit');
            Route::get('/recruitment_form_ages/destroy/{id}', 'destroy')->name('recruitment_form_ages.destroy');
        });

    Route::controller(RecruitmentFormOccupationController::class)
        ->group(function ($router) {
            Route::get('/recruitment_form_occupation/edit/{id}', 'edit')->name('recruitment_form_occupation.edit');
            Route::get('/recruitment_form_occupation/destroy/{id}', 'destroy')->name('recruitment_form_occupation.destroy');
        });
    Route::controller(RecruitmentAccommodationTypeController::class)
        ->group(function ($router) {
            Route::get('/accommodation_type/edit/{id}', 'edit')->name('accommodation_type.edit');
            Route::get('/accommodation_type/destroy/{id}', 'destroy')->name('accommodation_type.destroy');

        });
    Route::controller(RecruitmentFormReligionController::class)
        ->group(function ($router) {
            Route::get('/recruitment_form_religions/edit/{id}', 'edit')->name('recruitment_form_religions.edit');
            Route::get('/recruitment_form_religions/destroy/{id}', 'destroy')->name('recruitment_form_religions.destroy');

        });
    Route::controller(RecruitmentFormSocialStatusController::class)
        ->group(function ($router) {
            Route::get('/recruitment_form_social_status/edit/{id}', 'edit')->name('recruitment_form_social_status.edit');
            Route::get('/recruitment_form_social_status/destroy/{id}', 'destroy')->name('recruitment_form_social_status.destroy');

        });

    Route::controller(BookingStatusController::class)
        ->group(function ($router) {
            Route::get('/booking/status/index', 'index')->name('booking_status.view');
            Route::get('/booking/status/edit/{id}', 'edit')->name('booking_status.edit');

            Route::post('/booking/status/update/{id}', 'update')->name('booking_status.update');

        });

    Route::controller(NationalityController::class)
        ->group(function ($router) {
            Route::post('/nationalities/post/{id}', 'update');
            Route::post('/nationalities/status', 'updateStatus')->name('nationalities.status');
            Route::post('/nationalities/apper/status', 'updateApperStatus')->name('nationalities.apper.status');
            Route::get('/nationalities/destroy/{id}', 'destroy')->name('nationalities.destroy');
        });
    Route::controller(CountryController::class)
        ->group(function ($router) {
            Route::post('/countries/status', 'updateStatus')->name('countries.status');
            Route::get('/countries/destroy/{id}', 'destroy')->name('countries.destroy');
            Route::get('/allCountries', 'getAllActiveCountries')->name('countries.list');
        });


    Route::controller(CityController::class)
        ->group(function ($router) {
            Route::get('/cities/edit/{id}', 'edit')->name('cities.edit');
            Route::get('/cities/destroy/{id}', 'destroy')->name('cities.destroy');
            Route::get('/allCities', 'getAllCities')->name('cities.list');
            Route::post('/get-city', 'get_city')->name('get-city');
            Route::post('/get_city_id', 'get_city_id')->name('get_city_id');
            Route::post('/get_city_list', 'get_city_list')->name('get_city_list');

        });
    Route::resource('recruitment_form_ages', RecruitmentFormAgeController::class,['except' => ['destroy']]);
    Route::resource('recruitment_form_occupation', RecruitmentFormOccupationController::class,['except' => ['destroy']]);
    Route::resource('accommodation_type', RecruitmentAccommodationTypeController::class,['except' => ['destroy']]);
    Route::resource('recruitment_form_religions', RecruitmentFormReligionController::class,['except' => ['destroy']]);
    Route::resource('recruitment_form_social_status', RecruitmentFormSocialStatusController::class,['except' => ['destroy']]);
    Route::resource('nationalities', NationalityController::class,['except' => ['destroy']]);
    Route::resource('countries', CountryController::class,['except' => ['destroy']]);
    Route::resource('cities', CityController::class,['except' => ['destroy']]);

    /*===============================================*/

    /*==================== المكاتب الخارجية  ==================*/

    Route::controller(OfficeController::class)
        ->group(function ($router) {
            Route::post('/offices/profile/{id}', 'updateProfile')->name('offices.profile.update');
            Route::get('/offices/edit/{id}', 'edit')->name('offices.edit');
            Route::get('/offices/ban/{id}', 'ban')->name('offices.ban');
            Route::get('/offices/unban/{id}', 'unban')->name('offices.unban');
            Route::get('/office/show/{id}', 'showDetailes')->name('offices.show');
            Route::get('/offices/destroy/{id}', 'destroy')->name('offices.destroy');

        });

    Route::post('/office/country', [OfficeProfileController::class,'getCountryOfOffice'])->name('getOfficeCountry');
    Route::resource('offices', OfficeController::class,['except' => ['destroy','edit','show']]);
    Route::resource('/officeProfiles', OfficeProfileController::class);

    /*===============================================*/

    /*==================== ادارة العملاء  ==================*/
    Route::controller(CustomerController::class)
        ->group(function ($router) {
            Route::get('customers_ban/{customer}', 'ban')->name('customers.ban');
            Route::get('/customers/login/{id}', 'login')->name('customers.login');
            Route::get('/customers/destroy/{id}', 'destroy')->name('customers.destroy');
            Route::post('/bulk-customer-delete', 'bulk_customer_delete')->name('bulk-customer-delete');
            Route::post('/bulk-customer-ban', 'bulk_customer_ban')->name('bulk_customer_ban');
        });
    Route::controller(ClientOutController::class)
        ->group(function ($router) {
            Route::get('/clientouts/destroy/{id}', 'destroy')->name('clientouts.destroy');
            Route::get('/clientouts_bulk_upload/export', 'export')->name('clientouts.export');
            Route::post('/bulk-customerout-delete', 'bulk_customer_delete')->name('bulk-customerout-delete');

        });
    Route::controller(SubscriberController::class)
        ->group(function ($router) {
            Route::get('/subscribers', 'index')->name('subscribers.index');
            Route::get('/subscribers/destroy/{id}', 'destroy')->name('subscriber.destroy');
        });
    Route::controller(ContactUsController::class)
        ->group(function ($router) {
            Route::get('/contact_us/destroy/{id}', 'destroy')->name('contact_us.destroy');
            Route::post('contact_us/reply', 'send')->name('contact_us.send_reply');
            Route::get('/contact_us_bulk_upload/export', 'export')->name('contact_us.export');
            Route::post('/contact_us_change_status', 'contact_us_change_status')->name('contact_us_change_status');
        });
    Route::controller(FollowUpController::class)
        ->group(function ($router) {
            Route::get('/customer/followUp', 'customer_follow_up')->name('customer.follow_up');
            Route::get('/reservations/followUp', 'reservations_follow_up')->name('reservations.follow_up');
        });
    Route::controller(CentralBulkUploadController::class)
        ->group(function ($router) {
            Route::get('/central-bulk-upload/index', 'index')->name('central_bulk_upload.index');
            Route::post('/bulk-central-upload', 'central_bulk_upload')->name('bulk_central_upload');
            Route::post('/change-central-status', 'change_central_status')->name('change_central_status');
            Route::post('/change-central-details', 'change_central_details')->name('change_central_details');
            Route::post('/forward_call_central', 'forwardCallCentral')->name('forward_call_central');
            Route::post('/get_central', 'get_central')->name('get_central');
            Route::get('/get_central_data', 'getCentralData')->name('get_central_data');
            Route::get('/central/destroy/{id}', 'destroy')->name('central.destroy');
        });
    Route::resource('customers', CustomerController::class,['except' => ['destroy']]);
    Route::resource('clientouts', ClientOutController::class,['except' => ['destroy']]);
    Route::resource('contact_us', ContactUsController::class,['except' => ['destroy']]);
    Route::get('/customer-bulk-upload/export', [CustomerBulkUploadController::class,'export'])->name('pdf.export_user');

    /*===============================================*/

    /*==================== ادارة طلبات الاستقدام  ==================*/

    Route::controller(BookingCvController::class)
        ->group(function ($router) {
            Route::post('/changeAdminCV/add', 'changeAdminCV')->name('changeAdminCV');
            Route::post('/changeAdministrationCV/add', 'changeAdministrationCV')->name('changeAdministrationCV');
            Route::get('/booking_cv_request/add/{user_id?}', 'create')->name('booking_cv_request.add');
            Route::get('/booking_cv_request/create/{cv_id}/{user_id?}', 'createReservations')->name('booking_cv_request.create');
            Route::post('/booking_cv_request/store', 'store')->name('booking_cv_request.store');
            Route::get('/booking_cv_request/view/{id}', 'BookingCvView')->name('booking_cv_request.view');
            Route::post('/booking_cv_request/destroy', 'destroy')->name('booking_cv_request.destroy');
            Route::get('/booking_cv_request/index', 'BookingCvIndex')->name('booking_cv_request.index');
            Route::post('/update_booking_status/index', 'update_booking_status')->name('update_booking_status.update');
            Route::post('/update_booking_admin/index', 'update_booking_admin')->name('update_booking_admin.update');
            Route::get('/deleted_booking_cv_request/index', 'DeletedBookingCvIndex')->name('deleted_booking_cv_request.index');
            Route::post('/return_booking_available', 'return_booking_available')->name('return_booking_available');
            Route::get('reservations/export/', 'export')->name('reservations_export');
        });
    Route::controller(RecruitmentFormController::class)
        ->group(function ($router) {
            Route::get('/recruitment_form_request/view/{id}', 'recruitmentFormViewRequest')->name('recruitment_form_request.view');
            Route::post('/recruitment_form_request/destroy', 'destroy')->name('recruitment_form_request.destroy');
            Route::get('/recruitment_form_request/index', 'recruitmentFormIndexRequest')->name('recruitment_form_request.index');
            Route::post('/update-recruitment-request', 'updateRecruitmentForm')->name('recruitment.request.update');
            Route::get('/recruitment_form/view', 'index')->name('recruitment_form.view');
            Route::post('/recruitment_form/edit', 'store')->name('recruitment_form.edit');
        });
    /*===============================================*/

    /*==================== ادارة العقود  ==================*/
    Route::controller(ContractController::class)
        ->group(function ($router) {
            Route::get('/initial_contracts', 'InitalContractIndex')->name('initial_contracts.index');
            Route::get('/show_contract/{id}', 'show')->name('show.contract');
            Route::get('contract_delivery_form/download/{contract_id}', 'deliveryFormDownload')->name('contract_delivery_form.download');
            Route::post('/bulk_contract_upload', 'bulk_contract_upload')->name('bulk_contract_upload');
            Route::post('/fetch_details_contract', 'fetch_details_contract')->name('fetch_details_contract');
            Route::post('contact/cancelled', 'cancelled')->name('contact.cancelled');
            Route::get('contract/export/',  'export')->name('contract_export');
            Route::get('check_export/contract/export/',  'check_export')->name('check_contract_export');
            Route::get('check_export/contract/remove/',  'remove_check_export')->name('remove_check_export');

            Route::post('/contract_attatchment/{id}', 'addAttatchment')->name('contract.attachments');
        });
    /*==================== ادارة جهات العقود  ==================*/
    Route::controller(ContractSourceController::class)
        ->group(function ($router) {
            Route::get('/contract_source/create', 'create')->name('contract_source.create');
            Route::post('/contract_source', 'store')->name('contract_source.store');
            Route::get('/contract_sources', 'index')->name('contract_sources.index');
            Route::post('/contract_sources/destroy/{id}', 'destroy')->name('contract_source.destroy');

        });
    /*==================== نهاية جهات العقود  ==================*/


    Route::controller(AccreditationContractController::class)
        ->group(function ($router) {
            Route::get('/accreditation_contracts', 'index')->name('accreditation_contracts.index');
            Route::post('/accreditation_contracts/accept', 'accept')->name('accreditation_contracts.accept');
            Route::post('/accreditation_contracts/destroy', 'destroy')->name('accreditation_contracts.destroy');
        });
    Route::controller(NewContractController::class)
        ->group(function ($router) {
            Route::get('/new_contracts', 'index')->name('new_contracts.index');
            Route::post('/new_contracts/accept', 'accept')->name('new_contracts.accept');
            Route::post('/new_contracts/lastStep', 'lastStep')->name('new_contracts.lastStep');
        });
    Route::controller(TicketContractController::class)
        ->group(function ($router) {
            Route::get('/ticket_contracts', 'index')->name('ticket_contracts.index');
            Route::post('/ticket_contracts/accept', 'accept')->name('ticket_contracts.accept');
            Route::post('/ticket_contracts/lastStep', 'lastStep')->name('ticket_contracts.lastStep');
        });

    Route::controller(ArrivedContractController::class)
        ->group(function ($router) {
            Route::get('/arrived_contract', 'index')->name('arrived_contract.index');
            Route::get('/escaped_contract', 'escapeIndex')->name('escaped_contract.index');
            Route::post('/arrived_contract/accept', 'accept')->name('arrived_contract.accept');
            Route::post('/arrived_contract/lastStep', 'lastStep')->name('arrived_contract.lastStep');
            Route::get('/late_arrived_contract/view', 'late_arrived_index')->name('late_arrived_contract.view');
            Route::get('arrive_contract/export/',  'export')->name('arrive_contract_export');
            Route::post('/arrived_contract/escape/{id}', 'escape')->name('arrived_contract.escape');
            Route::get('/arrived_contract/cancel_escape/{id}', 'cancelEscape')->name('cancel_escape');
        });
    Route::controller(CoveredGuaranteeContractController::class)
        ->group(function ($router) {
            Route::get('/covered_guarantee', 'index')->name('covered_guarantee.index');
            Route::post('/covered_guarantee/lastStep', 'lastStep')->name('covered_guarantee.lastStep');

        });
    Route::controller(ThrowbackContractController::class)
        ->group(function ($router) {
            Route::get('/throwback', 'index')->name('throwback.index');
            Route::get('throwback_contract/export/', 'export')->name('throwback_contract_export');
            Route::get('/back_contract_step/{id}', 'back_contract_step')->name('back_contract_step');

        });

    Route::controller(ElectricAuthContractController::class)
        ->group(function ($router) {
            Route::get('/electric_auth_contracts', 'index')->name('electric_auth_contracts.index');
            Route::post('/electric_auth_contracts/lastStep', 'lastStep')->name('electric_auth_contracts.lastStep');
            Route::post('/electric_auth_contracts/accept', 'accept')->name('electric_auth_contracts.accept');
        });
    Route::controller(VisaContractController::class)
        ->group(function ($router) {
            Route::get('/visa_contracts', 'index')->name('visa_contracts.index');
            Route::post('/visa_contracts/accept', 'accept')->name('visa_contracts.accept');
            Route::post('/visa_contracts/lastStep', 'lastStep')->name('visa_contracts.lastStep');
        });
    Route::controller(MusandContractController::class)
        ->group(function ($router) {
            Route::get('/musaned_contracts', 'index')->name('musaned_contracts.index');
            Route::post('/musaned_contracts/lastStep', 'lastStep')->name('musaned_contracts.lastStep');
            Route::post('/musaned_contracts/accept', 'accept')->name('musaned_contracts.accept');
        });
    Route::controller(NoteContractController::class)
        ->group(function ($router) {
            Route::get('/notes/edit/{id}', 'edit')->name('notes.edit');
            Route::get('/notes/destroy/{id}', 'destroy')->name('notes.destroy');
        });
    Route::resource('contracts', ContractController::class,['except' => ['destroy']]);
    Route::resource('notes', NoteContractController::class,['except' => ['destroy']]);

    /*===============================================*/
    /*==================== ادارة الشكاوى  ==================*/
    Route::controller(SupportTicketController::class)
        ->group(function ($router) {
            Route::get('support_ticket/{type}', 'admin_index')->name('support_ticket.admin_index');
            Route::post('res/type/support_ticket', 'dataTypeSupportTicket')->name('support_ticket.date_res');
            Route::post('create/support_ticket', 'adminStore')->name('support_ticket.adminStore');
            Route::post('create/support_ticket/edit/{id}', 'adminUpdate')->name('support_ticket.adminUpdate');
            Route::get('support_ticket/ticket/{id}', 'editBack')->name('support_ticket_back.edit');
            Route::get('support_ticket/create/ticket', 'create')->name('support_ticket_back.create');
            Route::get('support_ticket/{id}/show', 'admin_show')->name('support_ticket.admin_show');
            Route::post('reply/support_ticket', 'admin_store')->name('support_ticket.admin_store');
            Route::post('change_status', 'change_status')->name('support_ticket.change_status');
            Route::post('send_messesage', 'send_messesage')->name('support_ticket.send_messesage');
            Route::post('forward/ticket', 'forwardTicket')->name('support_ticket.forward_ticket');
            Route::get('/support_ticket_destroy/{id}', 'destroy')->name('support_ticket_destroy');
        });
    Route::resource('ticket_notes', \App\Http\Controllers\Admin\SupportTicketManagement\TicketNoteController::class,['except' => ['destroy']]);

    /*===============================================*/

    /*==================== الاعدادات  ==================*/
    Route::controller(HomeController::class)
        ->group(function ($router) {
    Route::get('/', 'admin_dashboard')->name('admin.dashboard');
    Route::get('calender', 'calender')->name('admin.calender');
    Route::post('/new-user-email', 'update_email')->name('admin.user.change.email');
            Route::post('/new-user-email', 'update_email')->name('admin.user.change.email');
            Route::get('/frequently_questioned_add', 'frequently_questioned_add')->name('frequently_questioned_add');
            Route::post('/frequently_questioned_create', 'frequently_questioned_create')->name('frequently_questioned_create');
            Route::get('/frequently_questioned', 'frequently_questioned')->name('frequently_questioned.view');
            Route::get('/frequently_questioned/{id}', 'frequently_questioned_edit')->name('frequently_questioned.edit');
            Route::post('/frequently_questioned_update', 'frequently_questioned_update')->name('frequently_questioned.update');
            Route::get('/frequently_questioned-destroy/{id}', 'frequently_questioned_destroy')->name('frequently_questioned.destroy');
            Route::get('/whatsaap_details/view', 'whatsapp_details')->name('whatsapp_details.view');
            Route::get('calender', 'calender')->name('admin.calender');
            Route::post('/get_reservations_ajax', 'AjexRservationAdmins')->name('get_reservations_ajax');

        });
    Route::controller(AizUploadController::class)
        ->group(function ($router) {
            Route::any('/uploaded-files/file-info', 'file_info')->name('uploaded-files.info');
            Route::get('/uploaded-files/destroy/{id}', 'destroy')->name('uploaded-files.destroy');
        });
    Route::controller(UserController::class)
        ->group(function ($router) {
            Route::get('userInfo/{idOfUser}', 'getUserInfo')->name('userInfo');
            Route::get('/check_phone', 'check_phone')->name('check_phone');
        });
    Route::controller(ServiceController::class)
        ->group(function ($router) {
            Route::get('/services/edit/{id}', 'edit')->name('services.edit');
            Route::get('/services/destroy/{id}', 'destroy')->name('services.destroy');
        });

    Route::controller(MusanedController::class)
        ->group(function ($router) {
            Route::get('/musaned/view', 'index')->name('musaned.view');
            Route::post('/musaned/edit', 'store')->name('musaned.edit');
        });

    Route::controller(NotificationController::class)
        ->group(function ($router) {
            Route::post('/update/admin/notifications', 'update_admin_seen_notfication')->name('update_admin_seen_notfication');
            Route::get('/notifications', 'admin_listing')->name('admin.notifications');
            Route::get('/user_logs', 'user_logs')->name('admin.user_logs');
            Route::post('/update/sound/notifications', 'update_sound_notfication')->name('update_sound_notfication');

        });
    Route::controller(RecruitmentStepController::class)
        ->group(function ($router) {
            Route::get('/recruitment_steps/edit/{id}', 'edit')->name('recruitment_steps.edit');
            Route::get('/recruitment_steps/destroy/{id}', 'destroy')->name('recruitment_steps.destroy');
            Route::get('/recruitment_steps/destroy/all', 'destroyAll')->name('recruitment_steps.all');
        });
    Route::controller(RecruitmentReferenceController::class)
        ->group(function ($router) {
            Route::get('/recruitment_references/edit/{id}', 'edit')->name('recruitment_references.edit');
            Route::get('/recruitment_references/destroy/{id}', 'destroy')->name('recruitment_references.destroy');
        });
    Route::controller(RecruitmentRequirementController::class)
        ->group(function ($router) {
            Route::get('/recruitment_requirements/edit/{id}', 'edit')->name('recruitment_requirements.edit');
            Route::get('/recruitment_requirements/destroy/{id}', 'destroy')->name('recruitment_requirements.destroy');
        });
    Route::controller(RecruitmentRequirementDetailController::class)
        ->group(function ($router) {
            Route::get('/recruitment_references_detailes/edit/{id}', 'edit')->name('recruitment_requirements_detailes.edit');
            Route::get('/recruitment_references_detailes/destroy/{id}', 'destroy')->name('recruitment_requirements_detailes.destroy');
        });
    Route::controller(NewsletterController::class)
        ->group(function ($router) {
            Route::get('/newsletter', 'index')->name('newsletters.index');
            Route::post('/newsletter/send', 'send')->name('newsletters.send');
            Route::get('/massage', 'massageIndex')->name('massage.index');
            Route::get('/massage/list/{id}', 'massagelist')->name('massage.list');
            Route::post('/massage/send', 'massageSend')->name('massage.send');
            Route::post('/newsletter/test/smtp', 'testEmail')->name('test.smtp');
        });


    // website setting
    Route::group(['prefix' => 'website'], function () {
//        Route::view('/header', 'backend.SettingManagement.website_settings.header')->name('website.header');
//        Route::view('/footer', 'backend.SettingManagement.website_settings.footer')->name('website.footer');
        Route::view('/pages', 'backend.SettingManagement.website_settings.pages.index')->name('website.other_pages');
        Route::view('/appearance', 'backend.SettingManagement.website_settings.appearance')->name('website.appearance');
        Route::view('/loading', 'backend.SettingManagement.loading')->name('website.loading');
        Route::view('/main', 'backend.SettingManagement.main_page.main')->name('website.main');
        Route::view('/other_pages', 'backend.SettingManagement.other_pages.other_pages')->name('website.other_pages');
        Route::resource('custom-pages', PageController::class,['except' => ['destroy']]);

        Route::controller(PageController::class)
            ->group(function ($router) {
                Route::get('/custom-pages/show_custom_page/{id}', 'show')->name('custom-pages.show_custom_page');
                Route::get('/custom-pages/edit/{id}', 'edit')->name('custom-pages.edit');
                Route::get('/custom-pages/destroy/{id}', 'destroy')->name('custom-pages.destroy');
            });
    });
    Route::controller(BlogController::class)
        ->group(function ($router) {
            Route::get('/blog/destroy/{id}', 'destroy')->name('blog.destroy');
            Route::post('/blog/change-status', 'change_status')->name('blog.change-status');
        });
    Route::controller(BusinessSettingsController::class)
        ->group(function ($router) {
            Route::post('/env_key_update', 'env_key_update')->name('env_key_update.update');
            Route::post('/business-settings/update', 'update')->name('business_settings.update');
            Route::post('/business-settings/update/activation', 'updateActivationSettings')->name('business_settings.update.activation');
        });
    Route::controller(LanguageController::class)
        ->group(function ($router) {
            Route::post('/languages/{id}/update', 'update')->name('languages.update');
            Route::get('/languages/destroy/{id}', 'destroy')->name('languages.destroy');
            Route::post('/languages/update_rtl_status', 'update_rtl_status')->name('languages.update_rtl_status');
            Route::post('/languages/key_value_store', 'key_value_store')->name('languages.key_value_store');
        });

    Route::controller(RoleController::class)
        ->group(function ($router) {
            Route::get('/roles/edit/{id}', 'edit')->name('roles.edit');
            Route::get('/roles/destroy/{id}', 'destroy')->name('roles.destroy');
        });
    Route::controller(StaffController::class)
        ->group(function ($router) {
            Route::get('/staffs/destroy/{id}', 'destroy')->name('staffs.destroy');
            Route::get('/staffs/ban/{id}', 'ban')->name('staffs.ban');
            Route::post('/foreign_official', 'foreign_official')->name('staffs.foreign_official');
            Route::post('/staffs/change/seen', 'changeSeen')->name('staffs.change.seen');
            Route::post('/staffs/changeback/seen', 'changeBackSeen')->name('staffs.changeback.seen');
            Route::post('/staffs/airport/msg', 'changeAirportMsg')->name('staffs.airport.msg');
        });

//    Route::controller(RecruitmentClientController::class)
//        ->group(function ($router) {
//            Route::get('/client/home/view', 'index')->name('client_home.view');
//            Route::post('/client/home/edit', 'store')->name('client_home.edit');


//        });
    Route::controller(JobController::class)
        ->group(function ($router) {
            Route::get('/jobs/destroy/{id}', 'destroy')->name('jobs.destroy');
            Route::post('/jobs/change/status', 'changeStatus')->name('job.change.status');
            Route::get('applicants/list', 'applicantList')->name('applicants.index');
            Route::get('/applicants/destroy/{id}', 'applicantDestroy')->name('applicants.destroy');
        });

    Route::controller(TrainingController::class)
        ->group(function ($router) {
            Route::get('/training/destroy/{id}', 'destroy')->name('training.destroy');
            Route::post('/training/change/status', 'changeStatus')->name('training.change.status');
            Route::get('trainees/list', 'applicantList')->name('trainees.index');
            Route::get('/trainees/destroy/{id}', 'applicantDestroy')->name('trainees.destroy');
        });

//    Route::controller(VisaController::class)
//        ->group(function ($router) {
//            Route::get('/visa/view', 'index')->name('vise.view');
//            Route::get('/newuser/visa/view', 'newuser')->name('vise.view_newuser');
//            Route::get('/accountuser/visa/view', 'accountuser')->name('vise.view_accountuser');
//
//        });



    Route::resource('jobs', JobController::class,['except' => ['destroy']]);
    Route::resource('training', TrainingController::class,['except' => ['destroy']]);
    Route::resource('/uploaded-files', AizUploadController::class,['except' => ['destroy']]);
    Route::resource('profile', ProfileController::class,['except' => ['destroy']]);
    Route::resource('services', ServiceController::class,['except' => ['destroy','edit']]);
    Route::resource('recruitment_steps', RecruitmentStepController::class,['except' => ['destroy','edit']]);
    Route::resource('recruitment_references', RecruitmentReferenceController::class,['except' => ['destroy','edit']]);
    Route::resource('recruitment_requirements', RecruitmentRequirementController::class,['except' => ['destroy','edit']]);
    Route::resource('recruitment_references_detailes', RecruitmentRequirementDetailController::class,['except' => ['destroy']]);
    Route::resource('blog', BlogController::class,['except' => ['destroy']]);
    Route::resource('seo_setting', SeoController::class,['except' => ['destroy']]);
    Route::get('/seo_setting/destroy/{id}', [SeoController::class,'destroy'])->name('seo.destroy');
    Route::resource('/languages', LanguageController::class,['except' => ['destroy']]);
    Route::resource('roles', RoleController::class,['except' => ['destroy','edit']]);
    Route::resource('staffs', StaffController::class,['except' => ['destroy']]);
    Route::post('/policies/edit', [PolicyRecruitmentController::class,'store'])->name('policies.edit');

    Route::resource('read_common_topics', ReadCommonTopicController::class,['except' => ['destroy']]);
    Route::get('/read_common_topics/destroy/{id}', [ReadCommonTopicController::class,'destroy'])->name('read_common_topics.destroy');
    Route::resource('common_topics', CommonTopicController::class,['except' => ['destroy']]);
    Route::get('/common_topics/destroy/{id}', [CommonTopicController::class,'destroy'])->name('common_topics.destroy');

    /*===============================================*/
    /*==================== ا ==================*/
    /*===============================================*/


});