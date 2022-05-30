<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use Config\Services; 


/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ["form", "url", "text", "date", 'security'];
    protected $session;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();

        $this->session = \Config\Services::session();
        $this->request = service('request');
        $this->setting_model = model(SettingModel::class);
        $this->appointment_model = model(AppointmentModel::class);
        $this->user_model = model(UserModel::class);
        $this->patient_model = model(PatientModel::class);
        $this->document_model = model(DocumentModel::class);
        $this->vitals_model = model(VitalsModel::class);
        $this->diagnosis_model = model(DiagnosisModel::class);
        $this->prescription_model = model(PrescriptionModel::class);
        $this->laboratory_model = model(LaboratoryModel::class);
        $this->billing_model = model(BillingModel::class);
        $this->billing_details_model = model(BillingDetailsModel::class);
        $this->pharmacy_billing_model = model(PharmacyBillingModel::class);
        $this->pharmacy_billing_details_model = model(PharmacyBillingDetailsModel::class);
        $this->noticeboard_model = model(NoticeBoardModel::class);
        $this->message_model = model(MessageModel::class);
    }
}
