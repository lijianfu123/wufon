<?php

namespace app\api2\controller;

use app\api2\model\UserController;

class LoginController extends BaseController
{
    public function test()
    {
        $user_model = new UserController();
        $user_model->where('id', 'eq', 25)->setField(['openid' => 'test', 'wx_session_key' => 'hcbbcchjbhjhhj']);
    }

    public function wxApplet()
    {
        $this->require = ['code', 'encryptedData', 'iv'];
        $this->jsonVerify();
        $user_model = new UserController();
        // verify auth
        $auth_data = $user_model->getWxAuth($this->data['code']);
        if (!$auth_data) {
            $this->jsonError('auth_error');
        }
        //  verify phone number
        if (empty($this->data['encryptedData']) || empty($this->data['iv'])) {
            $this->jsonError('auth_error');
        }
        $this->data['session_key'] = $auth_data['session_key'];
        $json_data = $user_model->verifyWxMobile($this->data);
        if (empty($json_data)) {
            $this->jsonError('auth_error');
        }
        $mobile_data = json_decode($json_data, true);
        if (empty($mobile_data['phoneNumber'])) {
            $this->jsonError('auth_error');
        }
        if (!$user_model->exists(['mobile' => $mobile_data['phoneNumber']])) {
            $save_data = [
                'mobile' => $mobile_data['phoneNumber'],
                'openid' => $auth_data['openid'],
                'wx_session_key' => $auth_data['session_key']
            ];
            if (!$user_model->memberRegister($save_data)) {
                $this->jsonError('login_error');
            }
        }
        $data = $user_model->memberLogin(['account' => $mobile_data['phoneNumber']]);
        if (!$data) {
            $this->jsonError($user_model->getError());
        }
        $user_model->where('id', $data['id'])->setField(['openid' => $auth_data['openid'], 'wx_session_key' => $auth_data['session_key']]);
        $data['face'] = $this->face_path . $data['face'];

        $this->jsonResult($data);
    }

}