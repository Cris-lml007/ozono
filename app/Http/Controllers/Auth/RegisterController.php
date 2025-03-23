<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
    protected $redirectTo = '/dashboard';

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
        $validator = Validator::make($data, [
            'ci' => ['required','exists:persons'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $validator->after(function ($validator) use ($data){
            $value = true;
            if(Person::where('ci',$data['ci'])->exists()){
                if(Person::where('ci',$data['ci'])->first()->user){
                    $value = false;
                }
            }else $value = false;
            if(!$value){
                $validator->errors()->add('error','No se pudo crear Usuario, pongase en contacto con su Administrador.');
            }
        });

        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Person::where('ci',$data['ci'])->update([
        //     'ci' => $data['ci'],
        //     'surname' => $data['surname'],
        //     'name' => $data['name'],
        //     'birthdate' => $data['birthdate'],
        //     'gender' => $data['gender']
        // ]);
        $person = Person::where('ci',$data['ci'])->first();
        return User::create([
            'person_id' => $person->id,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
