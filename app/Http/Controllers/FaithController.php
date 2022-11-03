<?php
/**
 * LUMEN API ( https://github.com/viticm/lumen-api )
 * $Id FaithController.php
 * @link https://github.com/viticm/lumen-api for the canonical source repository
 * @copyright Copyright (c) 2022 viticm( viticm.ti@gmail.com )
 * @license
 * @user viticm( viticm.ti@gmail.com )
 * @date 2022/11/02 11:26
 * @uses The faith game api controller.
 */
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Hautelook\Phpass\PasswordHash;
use App\Util;
use App\Http\Controllers\Controller;
use App\Models\FaithUser;

class FaithController extends Controller
{
    /**
     * The save all setting path.
     *
     * @var string
     */
    public static $settingPath = '/web/download/game/skynet-simple/';

    /**
     * The crypt key.
     *
     * @var string
     */
    public static $cryptKey = 'testfycs';

    /**
     * Defalut server.
     *
     * @var array
     */
    public static $defServer = ['81.70.92.235', 29621];


    /**
     * User login.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function userLogin(Request $request)
    {
        $sign_key = 'O6YuI4eS@l!N9WUs';
        $data = $request->input('data');
        $check_sign = $request->input('sign');
        if (md5($data . $sign_key) !== $check_sign) {
            return $this->failed('sign check failed', 1);
        }
        $info = json_decode($data, true);

        Log::info('The data:', $info);
        $data = array(
            'status' => 1,
            'id' => $info['user_name'],
            'special' => 1,
            'channel' => 100,
            'model' => 1
        );
        return $this->succeed(['user_info' => $data]);
    }

    /**
     * Login.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function login(Request $request)
    {
        return $this->succeed(['user_info' => []]);
    }

    /**
     * Guest login.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function guestLogin(Request $request)
    {
        return $this->succeed(['user_info' => []]);
    }

    /**
     * Register.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function register(Request $request)
    {
        return $this->succeed(['user_info' => []]);
    }

    /**
     * Onekey login.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function onekeyLogin(Request $request)
    {
        $params = $this->parseRequest();
        Log::info('params:', $params);
        $rules = [
            'account' => 'required',
        ];
        $messages = [
            'required' => 'account empty'
        ];
        $validator = Validator::make($params, $rules, $messages);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->failed($errors->first(), 60203);
        }
        $account = $params['account'];
        Log::info('onekeyLogin '.$account);
        $password = isset($params['password']) ? $params['password'] : null;
        $channel = $params['channel'] || 'main';
        $user = FaithUser::where('account', $account)->first();
        $passwordHasher = new PasswordHash(8, false);
        if (is_null($user)) {
            // 插入数据
            $user = new FaithUser();
            $user->account = $account;
            $user->password = $passwordHasher->HashPassword($password);
            $user->channel = $channel;
            if($user->save() === false) {
                return $this->failed("用户注册失败");
            }
        } else {
            // Check password.
            if ($passwordHasher->CheckPassword($password, $user->password) === false) {
                return $this->failed('密码错误');
            }
        }
        $token = auth()->fromUser($user);
        $user->token = $token;
        $user->save();

        return $this->succeed(['token' => $token, 'account' => $account]);
    }

    /**
     * Region list.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function regionList(Request $request)
    {
        $r = [
            'recommend' => [],
            'role' => [],
            'other' => [],
        ];
        $server_list = [];
        array_push($server_list, [
            'regionid' => 1,
            'sid' => 1,
            'state' => 1
        ]);
        $recommend_region = [
            0 => [
                'id'=>10000001,
                'servers' => $server_list
            ]
        ];
        $r['recommend'] = $recommend_region;
        $r['other'][1] = ['id' => 1];
        return $this->succeed($r);
    }

    /**
     * Server List.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function serverList(Request $request)
    {
        $r = [];
        array_push($r, [
            'regionid' => 1,
            'sid' => 1,
            'state' => 1
        ]);
        return $this->succeed($r);
    }

    /**
     * Role List.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function roleList(Request $request)
    {
        $user = auth()->user();
        if (is_null($user)) {
            return $this->failed('验证失败');
        }
        $r = [
            'server' => [
                'ip' => static::$defServer[0],
                'port' => static::$defServer[1],
            ],
            'roleinfo' => [],
            'game_token'=> $user->token
        ];
        return $this->succeed($r);
    }

    /**
     * Login point.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function loginPoint(Request $request)
    {
        $json = $this->parseRequest();
        Log::info('xxxxxxxxxxxxxxxxxxxxxxxxxxxxx', $json);
        return $this->succeed(['user_info' => []]);
    }

    /**
     * Version.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function version(Request $request)
    {
        return $this->succeed(['user_info' => []]);
    }

    /**
     * Api agreements.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function apiAgreements(Request $request)
    {
        return $this->succeed(['user_info' => []]);
    }

    /**
     * Notice.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function notice(Request $request)
    {
        return $this->succeed(['user_info' => []]);
    }

    /**
     * Maintenance Notice.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function maintenanceNotice(Request $request)
    {
        return $this->succeed(['user_info' => []]);
    }

    /**
     * Server status.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function serverStatus(Request $request)
    {
        return $this->succeed(['user_info' => []]);
    }

    /**
     * Login notice.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function loginNotice(Request $request)
    {
        return $this->succeed(['user_info' => []]);
    }

    /**
     * Verification gift.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function verificationGift(Request $request)
    {
        return $this->succeed(['user_info' => []]);
    }

    /**
     * Cancel order.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function cancelOrder(Request $request)
    {
        return $this->succeed(['user_info' => []]);
    }

    /**
     * Query order.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function queryOrder(Request $request)
    {
        return $this->succeed(['user_info' => []]);
    }

    /**
     * Pay validate.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function payValidate(Request $request)
    {
        return $this->succeed(['user_info' => []]);
    }

    /**
     * Card comment.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function cardComment(Request $request)
    {
        return $this->succeed(['user_info' => []]);
    }

    /**
     * Publish comment.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function publishComment(Request $request)
    {
        return $this->succeed(['user_info' => []]);
    }

    /**
     * Set card comment mark.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function setCardCommentMark(Request $request)
    {
        return $this->succeed(['user_info' => []]);
    }

    /**
     * Set card like.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function setCardLike(Request $request)
    {
        return $this->succeed(['user_info' => []]);
    }

    /**
     * Report error.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function reportError(Request $request)
    {
        return $this->succeed(['user_info' => []]);
    }

    /**
     * Check game token.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function checkGameToken(Request $request)
    {
        $user = auth()->user();
        if (is_null($user)) {
            return $this->failed('验证失败');
        }
        return $this->succeed();
    }

    /**
     * Report role info.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function reportRoleInfo(Request $request)
    {
        return $this->succeed();
    }

    /**
     * Rank list.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function rankList(Request $request)
    {
        return $this->succeed();
    }

    /**
     * Report rank.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function reportRank(Request $request)
    {
        return $this->succeed();
    }

    /**
     * Report point.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function reportPoint(Request $request)
    {
        return $this->succeed();
    }

    /**
     * Report task.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function reportTask(Request $request)
    {
        return $this->succeed();
    }

    /**
     * Login log.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function loginLog(Request $request)
    {
        return $this->succeed();
    }

    /**
     * Report prop change.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse json
     **/
    public function reportPropChange(Request $request)
    {
        return $this->succeed();
    }

    public function succeed($data = [], $message = "succeed", $code = 0)
    {
        return $this->encrypt(json_encode(
            ['msg' => $message, 'code' => $code, 'data'=> $data]));
    }

    public function failed($message = "failed", $code = -1)
    {
        return $this->encrypt(json_encode(['msg' => $message, 'code' => $code]));
    }

    protected function encrypt($d)
    {
        return openssl_encrypt($d, 'des-ecb', static::$cryptKey);
    }

    protected function decrypt($d)
    {
        return openssl_decrypt($d, 'des-ecb', static::$cryptKey);
    }

    protected function parseRequest()
    {
        $r = json_decode($this->decrypt(urldecode(file_get_contents('php://input'))), true);
        if(empty($r)) {
            $r = json_decode($this->decrypt(file_get_contents('php://input')), true);
        }
        return $r;
    }

}
