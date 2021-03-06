<?php
namespace App\Repositories\Home;

use App\Http\Requests\Api\Home\UserRequest;
use App\Http\Resources\Api\Home\UserResource;
use App\Jobs\Api\SaveLastTokenJob;
use App\Models\Home\User;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class UsersRepository extends BaseRepository
{
   public function index(Request $request)
   {
       $pageSize = $request->input('pageSize', 20);

       $users = User::query()->paginate($pageSize)->toArray();

       $result = SplitData($users);

       return $this->success($result);
   }

   public function show(User $user)
   {
       return $this->success(new UserResource($user));
   }

   public function store(UserRequest $request)
   {
       try {
           User::create($request->all());

           return $this->setStatusCode(201)->success(trans('api.user.store.success'));

       } catch (\Exception $e) {
           \Log::error(trans('api.user.store.failed') . $e->getMessage(), [
               'data' => $request->all()
           ]);
           return $this->failed(trans('api.user.store.failed'));
       }
   }

   public function login(Request $request)
   {
       //获取当前守护的名称
       $present_guard = \Auth::getDefaultDriver();

       if ($token = \Auth::claims(['guard' => $present_guard])->attempt(['name'=>$request->name, 'password'=>$request->password])) {


           $user = \Auth::user();

           if ($user->last_token) {
               try {

                   \Auth::setToken($user->last_token)->invalidate();

               } catch (TokenExpiredException $e) {

               }
           }

           dispatch(new SaveLastTokenJob($user, $token));

           return $this->setStatusCode(201)->success([
               'token' => 'bearer ' . $token,
               'token_type' => 'Bearer',
               'expires_in' => \Auth::guard('api')->factory()->getTTL()
           ]);

       }
       return $this->failed(trans('api.account.failed'),400);
   }

   public function logout()
   {
       \Auth::logout();

       return $this->success(trans('api.logout.success'));
   }

   public function info()
   {
       $user = \Auth::user();

       return $this->success(new UserResource($user));
   }


}