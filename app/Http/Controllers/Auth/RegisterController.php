<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\GeneralSettingsMeta;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\QuantumAcctMeta;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DateTime;
use DateTimeZone;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

    
        $timezoneOffsetSeconds = timezone_offset_get(new DateTimeZone(date_default_timezone_get()), new DateTime());

        // Create a new DateTime object with the current time and the timezone set above
        $timezoneOffsetFormatted = sprintf('%+03d:%02d', $timezoneOffsetSeconds / 3600, abs($timezoneOffsetSeconds) % 3600 / 60);
        

        // general Settings
        QuantumAcctMeta::create([
            'user_id' => $user->id,
            'subscription' => 'free',
            'timezone' => $timezoneOffsetFormatted
        ]);

        // 
        $generalSettingsMeta = [
            ['user_id' => $user->id, 'meta_key' => 'copy-text-break', 'meta_value' => '0' ],
            ['user_id' => $user->id, 'meta_key' => 'press-enter-3-times', 'meta_value' => '0' ],
            ['user_id' => $user->id, 'meta_key' => 'email-when-queue-empty', 'meta_value' => '0' ],
            ['user_id' => $user->id, 'meta_key' => 'refresh-cmd-add-queue', 'meta_value' => '0' ],
            ['user_id' => $user->id, 'meta_key' => 'random-post-times', 'meta_value' => '0' ]
        ];

        GeneralSettingsMeta::insert($generalSettingsMeta);
        
        return $user;
    }
}
