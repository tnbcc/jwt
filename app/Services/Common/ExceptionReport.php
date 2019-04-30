<?php
namespace App\Services\Common;

use App\Traits\Api\ApiResponse;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class ExceptionReport
{
    use ApiResponse;

    /**
     * @var Exception
     */
    public $exception;
    /**
     * @var Request
     */
    public $request;

    /**
     * @var
     */
    protected $report;

    protected $doReport;

    /**
     * ExceptionReport constructor.
     * @param Request $request
     * @param Exception $exception
     */
    function __construct(Request $request, Exception $exception)
    {
        $this->request = $request;
        $this->exception = $exception;
        $this->doReport = [
            AuthenticationException::class => [trans('api.exception.401'), 401], //未授权 401
            ModelNotFoundException::class => [trans('api.exception.404'), 404], //'该模型未找到', 404
            AuthorizationException::class => [trans('api.exception.403'), 403], //'没有此权限', 403
            ValidationException::class => [],
            UnauthorizedHttpException::class => [trans('api.exception.422'), 422], //'未登录或登录状态失效', 422
            TokenInvalidException::class => [trans('api.exception.400'), 400], //'token不正确', 400
            NotFoundHttpException::class => [trans('api.exception.not_find'), 404], //未找到该页面 404
            MethodNotAllowedHttpException::class => [trans('api.exception.405'), 405],//方法不正确 405
        ];
    }

    /**
     * @var array
     */
    //当抛出这些异常时，可以使用我们定义的错误信息与HTTP状态码
    //可以把常见异常放在这里

    public function register($className,callable $callback){

        $this->doReport[$className] = $callback;
    }

    /**
     * @return bool
     */
    public function shouldReturn()
    {
        //只有请求包含是json或者ajax请求时才有效
//        if (! ($this->request->wantsJson() || $this->request->ajax())){
//
//            return false;
//        }
        foreach (array_keys($this->doReport) as $report) {
            if ($this->exception instanceof $report) {
                $this->report = $report;
                return true;
            }
        }

        return false;

    }

    /**
     * @param Exception $e
     * @return static
     */
    public static function make(Exception $e)
    {

        return new static(\request(), $e);
    }

    /**
     * @return mixed
     */
    public function report()
    {
        if ($this->exception instanceof ValidationException) {

            $data = $this->exception->validator->getMessageBag();

            $error = array_first(collect($data));

            return $this->failed(array_first($error), $this->exception->status);
        }



        $message = $this->doReport[$this->report];

        return $this->failed($message[0], $message[1]);
    }

    public function prodReport()
    {
        return $this->failed(trans('api.exception.500'),'500');
    }
}