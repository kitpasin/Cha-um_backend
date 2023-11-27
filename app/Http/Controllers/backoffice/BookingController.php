<?php

namespace App\Http\Controllers\backoffice;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingSetting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\SendMailApproved;
use Illuminate\Support\Facades\Mail;
use App\Models\LanguageConfig;

class BookingController extends BaseController
{
    public function index(Request $req)
    {
        try {
            $orders = Booking::where('status', '!=', 'deleted')->orderBy('time_booking', 'DESC')->get()->all();
            $bookingSetting = BookingSetting::where("language", $req->language)->orderBy('created_at', 'DESC')->first();
            $settings = [
                'available_time' => ($bookingSetting) ? substr($bookingSetting->available_time, 1, -1) : "",
                'available_time_sunday' => ($bookingSetting) ? substr($bookingSetting->available_time_sunday, 1, -1) : "",
                'available_time_thursday' => ($bookingSetting) ? substr($bookingSetting->available_time_thursday, 1, -1) : "",
                'disable_by_date' => ($bookingSetting) ? substr($bookingSetting->disable_by_date, 1, -1) : "",
                'disable_by_day' => ($bookingSetting) ? substr($bookingSetting->disable_by_day, 1, -1) : "",
                'special_holiday' => ($bookingSetting) ? substr($bookingSetting->special_holiday, 1, -1) : "",
                'people_number' => ($bookingSetting) ? $bookingSetting->people_number : 1,
            ];
            return response([
                'message' => 'ok',
                'data' => $orders,
                'setting' => $settings
            ]);
        } catch (Exception $e) {
            return response([
                'message' => 'error',
                'description' => 'Something went wrong.',
                'errorsMessage' => $e->getMessage()
            ], 501);
        }
    }

    public function bookingApprove(Request $req)
    {
        $this->getAuthUser();
        $params = $req->all();
        try {
            $infos = $this->getWebInfo('',);
            $webInfo = $this->infoSetting($infos);
            $checkLangs = explode(",",  $params['id']);

            Booking::whereIn('id', $checkLangs)->update([
                'status' => 'confirm'
            ]);

            $bookings = Booking::whereIn('id', $checkLangs)->get();

            foreach ($bookings as $book) { // sending mail to users.
                $lang_config_settings = [];
                $lang_config = LanguageConfig::where(['language' => $book->language, 'page_control' => 9])->orderBy('id', 'DESC')->get();
                if (!empty($lang_config)) {
                    foreach ($lang_config as $key => $value) {
                        $lang_config_settings[$value->param] = $value->title;
                    }
                }
                $book->contentTitle = $lang_config_settings;
                Mail::to($book->email)->send(new SendMailApproved($book, $webInfo));
            }

            return response([
                'message' => 'ok',
                'bookings' => $bookings,
            ], 200);
        } catch (Exception $e) {
            return response([
                'message' => 'error',
                'description' => 'Something went wrong.',
                'errorsMessage' => $e->getMessage()
            ], 501);
        }
    }

    public function bookingDelete($id)
    {
        $this->getAuthUser();
        try {
            $checkLangs = explode(",", $id);
            $orders = Booking::whereIn('id', $checkLangs)->update([
                'status' => 'deleted'
            ]);
            return response([
                'message' => 'ok',
            ]);
        } catch (Exception $e) {
            return response([
                'message' => 'error',
                'description' => 'Something went wrong.',
                'errorsMessage' => $e->getMessage()
            ], 501);
        }
    }

    public function createBookingSetting(Request $req)
    {
        $this->getAuthUser();
        $params = $req->all();

        // $validator = Validator::make($req->all(), [
        // ]);
        // if($validator->fails()) {
        //     return $this->sendErrorValidators('Invalid params', $validator->errors());
        // }
        try {
            $bookingSetting = new BookingSetting();
            $bookingSetting->people_number = $params['people_number'];
            $bookingSetting->available_time = $params['available_time'];
            $bookingSetting->disable_by_date = $params['disable_by_date'];
            $bookingSetting->disable_by_day = $params['disable_by_day'];
            $bookingSetting->special_holiday = $params['special_holiday'];
            $bookingSetting->available_time_sunday = $params['available_time_sunday'];
            $bookingSetting->available_time_thursday = $params['available_time_thursday'];
            $bookingSetting->language = $params['language'];
            $bookingSetting->save();
            return response([
                'message' => 'ok',
                'description' => 'success'
            ], 201);
        } catch (Exception $e) {
            return response([
                'message' => 'error',
                'description' => 'Something went wrong.',
                'errorsMessage' => $e->getMessage()
            ], 501);
        }
    }



    ///////////////////////////////////////////////////////*Test API*/////////////////////////////////////////////////////////////////////////
    public function testApprove(Request $req)
    {
        $params = $req->all();
        try {
            $infos = $this->getWebInfo('',);
            $webInfo = $this->infoSetting($infos);
            $checkLangs = explode(",",  $params['id']);
            $contentTitle = [];

            Booking::whereIn('id', $checkLangs)->update([
                'status' => 'confirm'
            ]);

            $bookings = Booking::whereIn('id', $checkLangs)->get();
            // dd();
            foreach ($bookings as $book) { // sending mail to users.
                if ($book->language === "fr") {
                    $contentTitle = [
                        'confirmTitle' => 'Réservation Confirmée',
                        'name' => 'Bonjour',
                        'details' => 'Merci d’avoir réservé dans notre restaurant. Nous avons le plaisir de vous annoncer que votre réservation est confirmée. Voici le détail:',
                        'address' => 'Tamarind Thai restaurant Capbreton 16 Quai Bonamour 40 130 Capbreton',
                        'getMap' => 'Obtenir l’itinéraire',
                        'dateBooking' => 'Date of the booking',
                        'timeBooking' => 'Time of the booking',
                        'people' => 'Number of pers',
                        'moreDetails' => 'Si vous changer d’avis entre-temps, vous pouvez annuler en nous envoyant un email au tamarindcapbreton@gmail.com.
                                          Pour d’avantage d’information, n’hésitez pas à nous appeler au +33 5 58 42 17 13
                                          Nous serons ravis de vous accueillir prochainement.',
                        'cordialement' => 'Cordialement,',
                        'tamarind' => 'Tamarind',
                    ];
                } else {
                    $contentTitle = [
                        'confirmTitle' => 'Reservation confirmed',
                        'name' => 'Dear',
                        'details' => 'Thanks for your booking. We are pleased to confirm your reservation. Here is the detail:',
                        'address' => 'Tamarind Thai restaurant Capbreton 16 Quai Bonamour 40 130 Capbreton',
                        'getMap' => 'Get the itinerary',
                        'dateBooking' => 'Date of the booking',
                        'timeBooking' => 'Time of the booking',
                        'people' => 'Number of pers',
                        'moreDetails' => 'If you change your mind, you can cancel your booking by sending us an email to tamarindcapbreton@gmail.com.
                                          For more information, please call us on +33 5 58 42 17 13 .
                                          We are looking forward to welcoming you soon.',
                        'cordialement' => 'Cordialement,',
                        'tamarind' => 'Tamarind',
                    ];
                }

                $lang_config_settings = [];
                $lang_config = LanguageConfig::where(['language' => $book->language, 'page_control' => 9])->orderBy('id', 'DESC')->get();
                if (!empty($lang_config)) {
                    foreach ($lang_config as $key => $value) {
                        $lang_config_settings[$value->param] = $value->title;
                    }
                }
                // dd($lang_config_settings);
                $book->contentTitle = $lang_config_settings;
                Mail::to($book->email)->send(new SendMailApproved($book, $webInfo));
            }

            return response([
                'message' => 'ok',
                'bookings' => $bookings,
            ], 200);
        } catch (Exception $e) {
            return response([
                'message' => 'error',
                'description' => 'Something went wrong.',
                'errorsMessage' => $e->getMessage()
            ], 501);
        }
    }
}
