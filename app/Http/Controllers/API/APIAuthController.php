<?php
namespace App\Http\Controllers\API;

use App\Entities\Student;
use App\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Passport\HasApiTokens;

use DB;
use Datatables;
use Exception;
use Sentinel;
use Validator;
use Auth;

class APIAuthController extends Controller
{
    use HasApiTokens;

    /**
     * @SWG\Swagger(
     *     schemes={"http","https"},
     *     basePath="/api",
     *     @SWG\Info(
     *         version="1.0.0",
     *         title="API Documentation",
     *         description="This is a sample description for current API",
     *         termsOfService="",
     *         @SWG\License(
     *             name="Private License",
     *         )
     *     )
     * )
     */
    public function __construct(){}

    /**
     * @SWG\Post(
     *   path="/login",
     *   summary="Login endpoint for user",
     *   description="-",
     *   tags={"Authenticate"},
     *   consumes={"application/x-www-form-urlencoded"},
     *   produces={"application/json"},
     *   @SWG\Parameter(
     *       name="email",
     *       in="formData",
     *       description="Email to be validate for login",
     *       required=true,
     *       type="string",
     *       format="string",
     *       @SWG\Items(type="string"),
     *       collectionFormat="multi"
     *   ),
     *
     *   @SWG\Parameter(
     *       name="password",
     *       in="formData",
     *       description="user password to be validate in login",
     *       required=false,
     *       type="string",
     *       format="string",
     *       @SWG\Items(type="string"),
     *       collectionFormat="multi"
     *   ),
     *
     *   @SWG\Response(
     *     response=200,
     *     description="User data and token"
     *   ),
     *   @SWG\Response(
     *     response="500",
     *     description="Error Message"
     *   )
     * )
     */
    public function login(Request $request)
    {
        $response = ['status' => 'error', 'code' => 500];

        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'email'         => 'required',
                'password'      => 'required',
            ], [
                'email.required'    => 'Email tidak boleh kosong',
                'email.exists'      => 'Email tidak terdaftar',
            ]);

            if ($validator->fails())
                throw new Exception($validator->errors()->first());

            // Authenticate user
            $auth = [];
            $auth['email'] = $request->email;
            $auth['password'] = $request->password;
            $user = Sentinel::authenticate($auth, true);

            if (empty($user))
                throw new Exception('Kombinasi email dan password yang anda masukkan salah');

            // Call createToken function for personal access token
            $userModel = User::find($user->id);
            $token = $userModel->createToken('access_token')->accessToken;

            if (!$token)
                throw new Exception('Komunikasi dengan Auth Server gagal');

            $user->student = Student::find($userModel->parent_id);
            $user->access_token = $token;

            $response = [
                'status' => 'success',
                'code' => 200,
                'data' => $user
            ];

            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
            $response['message'] = $e->getMessage();
        }

        return response()->json($response);
    }
}
