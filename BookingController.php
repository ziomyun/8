<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Appointment;
use App\Models\RegistrationCode;

class BookingController extends Controller
{
    // ...

    public function store(Request $request)
{
    // 验证请求数据是否合法
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'name' => 'required|string',
        'lunar_solar' => 'required|in:阳历,阴历',
        'birthday' => 'required|date_format:Y-m-d',
        'child_name' => 'required|string',
        'appointment_date' => 'required|date_format:Y-m-d',
        'registration_code' => 'required|string|min:6',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'message' => $validator->errors()->first(),
        ]);
    }

    // 查询注册码是否存在且未使用过
    $registrationCode = RegistrationCode::where('code', $request->input('registration_code'))
        ->where('used', 0)
        ->first();

    if (!$registrationCode) {
        return response()->json([
            'status' => 'error',
            'message' => '无效的注册码',
        ]);
    }

    // 将预定信息存储到数据库中
    $appointment = new Appointment();
    $appointment->email = $request->input('email');
    $appointment->name = $request->input('name');
    $appointment->lunar_solar = $request->input('lunar_solar');
    $appointment->birthday = $request->input('birthday');
    $appointment->child_name = $request->input('child_name');
    $appointment->appointment_date = $request->input('appointment_date');
    $appointment->registration_code = $request->input('registration_code');

    if ($appointment->save()) {
        // 标记注册码为已使用
        $registrationCode->used = 1;
        $registrationCode->save();

        return response()->json([
            'status' => 'success',
            'message' => '预定信息已保存',
        ]);
    } else {
        return response()->json([
                'status' => 'error',
                'message' => '保存预定信息时出错',
            ]);
        }
    }

    // ...
public function index(Request $request)
{
    // 获取请求参数中的注册码
    $registrationCode = $request->input('registration_code');

    // 查询与注册码匹配的预约信息
    $appointments = Appointment::where('registration_code', $registrationCode)->get();

    return response()->json([
        'status' => 'success',
        'data' => $appointments
    ]);
}
}
