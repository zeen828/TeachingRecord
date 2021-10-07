[回上層目錄](../README.md)

# 程式語言 / 後端 / Laravel / 外掛套件 / L5 Repositories / 使用 / `Rest Controller`的教學

## **Description [描述]**
Rest Controller -

## **Teaching & Examples [教學&範例]**

### 執行指令
```bash
php artisan make:rest-controller "Folder/RestController"
# Request created successfully.
# Request created successfully.
# Controller created successfully.

# 增加的檔案
# app/Http/Controllers/RestControllersController.php
# app/Http/Requests/Folder/RestControllerCreateRequest.php
# app/Http/Requests/Folder/RestControllerUpdateRequest.php

# PS：
# RestControllersController.php
# 如果想創建有目錄結構的，因為套件有問題自動產生的檔案會有複數跟目錄問題，需要自行修改檔名和搬移到目錄內。
# 因為移動目錄了所以需要指定基礎Controller位置
```

### 基礎
```php
<?php

namespace App\Http\Controllers\Folder;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\RestControllerCreateRequest;
use App\Http\Requests\RestControllerUpdateRequest;
use App\Repositories\Folder\RestControllerRepository;
use App\Validators\Folder\RestControllerValidator;
// Base Controller
use App\Http\Controllers\Controller;

/**
 * Class RestControllersController.
 *
 * @package namespace App\Http\Controllers\Folder;
 */
class RestControllersController extends Controller
{
    /**
     * @var RestControllerRepository
     */
    protected $repository;

    /**
     * @var RestControllerValidator
     */
    protected $validator;

    /**
     * RestControllersController constructor.
     *
     * @param RestControllerRepository $repository
     * @param RestControllerValidator $validator
     */
    public function __construct(RestControllerRepository $repository, RestControllerValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $restControllers = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $restControllers,
            ]);
        }

        return view('restControllers.index', compact('restControllers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RestControllerCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(RestControllerCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $restController = $this->repository->create($request->all());

            $response = [
                'message' => 'RestController created.',
                'data'    => $restController->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $restController = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $restController,
            ]);
        }

        return view('restControllers.show', compact('restController'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $restController = $this->repository->find($id);

        return view('restControllers.edit', compact('restController'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RestControllerUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(RestControllerUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $restController = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'RestController updated.',
                'data'    => $restController->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'RestController deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'RestController deleted.');
    }
}
```

```php
<?php

namespace App\Http\Requests\Folder;

use Illuminate\Foundation\Http\FormRequest;

class RestControllerCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
```

```php
<?php

namespace App\Http\Requests\Folder;

use Illuminate\Foundation\Http\FormRequest;

class RestControllerUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}

```

## **Reference article [參考文章]**
[參考文件]()

## **Author [作者]**
`Mr. Will`
