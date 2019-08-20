<?php
namespace App\Http\Controllers\API;

use App\Entities\Student;
use App\Entities\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

use DB;
use Datatables;
use Exception;
use Sentinel;
use Validator;
use Auth;

class APIProfileController extends Controller
{

    /**
     * @SWG\Get(
     *   path="/profile",
     *   summary="Get user profile",
     *   description="-",
     *   tags={"User"},
     *   consumes={"application/x-www-form-urlencoded"},
     *   produces={"application/json"},
     *   @SWG\Parameter(
     *       name="Authorization",
     *       in="header",
     *       description="User Access Token (eg: Bearer [user token])",
     *       required=true,
     *       type="string",
     *       format="string",
     *       @SWG\Items(type="string"),
     *       collectionFormat="multi"
     *   ),
     *
     *   @SWG\Response(
     *     response=200,
     *     description="User profile"
     *   ),
     *   @SWG\Response(
     *     response="500",
     *     description="Error Message"
     *   )
     * )
     */
    public function index(Request $request)
    {
        $response = ['status' => 'error', 'code' => 500];

        try {
            $user = Auth::guard('api')->user();
            $user->student = Student::find($user->parent_id);
            $response = [
                'status' => 'success',
                'code' => 200,
                'data' => $user
            ];

        } catch (Exception $e) {
            $response['message'] = $e->getMessage();
        }

        return response()->json($response);
    }

    /**
     * @SWG\Post(
     *   path="/profile",
     *   summary="Update profile user",
     *   description="-",
     *   tags={"User"},
     *   consumes={"application/x-www-form-urlencoded"},
     *   produces={"application/json"},
     *   @SWG\Parameter(
     *       name="Authorization",
     *       in="header",
     *       description="User Access Token (eg: Bearer [user token])",
     *       required=true,
     *       type="string",
     *       format="string",
     *       @SWG\Items(type="string"),
     *       collectionFormat="multi"
     *   ),
     *
     *   @SWG\Parameter(
     *       name="birth_date",
     *       in="formData",
     *       description="User birht date",
     *       required=false,
     *       type="string",
     *       format="string",
     *       @SWG\Items(type="string"),
     *       collectionFormat="multi"
     *   ),
     *
     *   @SWG\Parameter(
     *       name="birth_place",
     *       in="formData",
     *       description="User birth place",
     *       required=false,
     *       type="string",
     *       format="string",
     *       @SWG\Items(type="string"),
     *       collectionFormat="multi"
     *   ),
     *
     *   @SWG\Parameter(
     *       name="gender",
     *       in="formData",
     *       description="User Gender",
     *       required=false,
     *       enum={"male", "female"},
     *       type="string",
     *       format="string",
     *       @SWG\Items(type="string"),
     *       collectionFormat="multi"
     *   ),
     *
     *   @SWG\Parameter(
     *       name="religion",
     *       in="formData",
     *       description="User religion",
     *       required=false,
     *       type="string",
     *       format="string",
     *       @SWG\Items(type="string"),
     *       collectionFormat="multi"
     *   ),
     *
     *   @SWG\Response(
     *     response=200,
     *     description="Success message"
     *   ),
     *   @SWG\Response(
     *     response="500",
     *     description="Error Message"
     *   )
     * )
     */
    public function store(Request $request)
    {
        $response = ['status' => 'error', 'code' => 500];
        try {
            $user = Auth::guard('api')->user();
            $student = Student::find($user->parent_id);

            if ($request->birth_date)
                $student->birth_date = Carbon::parse($request->birth_date);

            $student->birth_place = $request->birth_place;
            $student->gender = $request->gender;
            $student->religion = $request->religion;
            $student->save();

            $response = [
                'status' => 'success',
                'code' => 200,
                'data' => $user
            ];

        } catch (Exception $e) {
            $response['message'] = $e->getMessage();
        }
        return response()->json($response);
    }

    /**
     * @SWG\Post(
     *   path="/profile/password",
     *   summary="Update password user",
     *   description="-",
     *   tags={"User"},
     *   consumes={"application/x-www-form-urlencoded"},
     *   produces={"application/json"},
     *   @SWG\Parameter(
     *       name="Authorization",
     *       in="header",
     *       description="User Access Token (eg: Bearer [user token])",
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
     *       description="User Password",
     *       required=true,
     *       type="string",
     *       format="string",
     *       @SWG\Items(type="string"),
     *       collectionFormat="multi"
     *   ),
     *
     *   @SWG\Parameter(
     *       name="confirm_password",
     *       in="formData",
     *       description="User confirm Password",
     *       required=true,
     *       type="string",
     *       format="string",
     *       @SWG\Items(type="string"),
     *       collectionFormat="multi"
     *   ),
     *
     *   @SWG\Response(
     *     response=200,
     *     description="Success message"
     *   ),
     *   @SWG\Response(
     *     response="500",
     *     description="Error Message"
     *   )
     * )
     */
    public function changePassword(Request $request)
    {
        $response = ['status' => 'error', 'code' => 500];

        $auth = Auth::guard('api')->user();
        \DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'password' => 'required|min:6',
                'confirm_password' => 'required|min:6',
            ]);

            if ($validator->fails()) {
                $response['message'] = $validator->errors()->all();
            } else {

                $user = User::find($auth->id);

                if (!$user)
                    throw new \Exception('User not found');

                if($request->password <> $request->confirm_password)
                    throw new \Exception('Password not match');

                $user->password = bcrypt($request->password);
                $user->save();
                $response = [
                    'status' => 'success',
                    'code' => 200,
                ];

                \DB::commit();
            }
        } catch (\Exception $e) {
            \DB::rollback();
            $response['message'] = $e->getMessage();
        }

        return response()->json($response);
    }
}
