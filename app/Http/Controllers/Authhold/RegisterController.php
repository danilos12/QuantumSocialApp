<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\GeneralSettings;
use App\Models\QuantumAcctMeta;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function showRegistrationForm()
    {
        return view('auth.register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'options' => 'required|in:Free,Premium',
        ]);
    }
    protected function create(array $data)
    {
        $user = User::create([

            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        DB::table('user_mngt')->insert([
            'main_id' => $user->id,
            'main_acct' => 1,
            'sub_acct' => 0
        ]);

        DB::table('app_usermeta')->insert([
            'user_id' => $user->id,
            'meta_key' => 'app_subscription',
            'meta_value' => $data['options'],
        ]);
        $timezoneOffsetSeconds = timezone_offset_get(new DateTimeZone(date_default_timezone_get()), new DateTime());

        // Create a new DateTime object with the current time and the timezone set above
        $timezoneOffsetFormatted = sprintf('%+03d:%02d', $timezoneOffsetSeconds / 3600, abs($timezoneOffsetSeconds) % 3600 / 60);


        // general Settings
        QuantumAcctMeta::create([
            'user_id' => $user->id,
            'subscription' => 'free',
            'timezone' => $timezoneOffsetFormatted,
            'subscription_free_counter' => 0,
            'member_count' => 0,
            'status' => 0
        ]);


        $generalSettings = [
            'user_id' => $user->id,
            'toggle_1' => 0,
            'toggle_2' => 0,
            'toggle_3' => 0,
            'toggle_4' => 0,
            'toggle_5' => 0,
            'toggle_6' => 0,
            'toggle_7' => 0,
        ];


        GeneralSettings::create($generalSettings);

        return ($user);
    }


}
