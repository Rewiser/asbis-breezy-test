<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Managers;
use App\Http\Resources\ManagerResource;

class ManagerController extends Controller
{
    public function select(Request $request)
    {
        $response = [];
        if ($request->has('id')) {
            $response = $this->getManagerByID($request->request->getInt('id'));
        }
        if($request->has('phone')) {
            $response = $this->getManagerByPhone($request->request->get('phone'));
        }
        if ($request->has('email')) {
            $response = $this->getManagerByEmail($request->request->get('email'));
        }
        return response($response);
    }

    public function create(Request $request) {
        if (!$request->has(['name', 'surname', 'middle_name', 'phone', 'email'])) {
            return response(['error' => 'fill in all fields']);
        }
        $manager = $this->createNewManager($request);
        return response($manager);
    }

    public function edit(Request $request) {
        if ($request->missing('id')) {
            return response(['error' => 'id is missing']);
        }
        $manager = $this->editManager($request);
        return response($manager);
    }

    public function delete(Request $request) {
        if ($request->missing('id')) {
            return response(['error' => 'id is missing']);
        }
        $status = $this->deleteManager($request);
        return response($status);
    }

    private function getManagerByID($id) {
        return new ManagerResource(Managers::find($id));
    }

    private function getManagerByPhone($phone) {
        return new ManagerResource(Managers::where('phone', $phone)->first());
    }

    private function getManagerByEmail($email) {
        return new ManagerResource(Managers::where('email', $email)->first());
    }

    private function createNewManager(Request $request) {
        $manager = new Managers();
        $manager->name = $request->request->get('name');
        $manager->surname = $request->request->get('surname');
        $manager->middle_name = $request->request->get('middle_name');
        $manager->phone = $request->request->get('phone');
        $manager->email = $request->request->get('email');
        $manager->save();
        return $manager;
    }

    private function editManager(Request $request) {
        $manager = Managers::find($request->request->getInt('id'));
        if (!$manager) {
            return ['error' => 'Manager not found'];
        }
        if ($request->has('name')) $manager->name = $request->request->get('name');
        if ($request->has('surname')) $manager->surname = $request->request->get('surname');
        if ($request->has('middle_name')) $manager->middle_name = $request->request->get('middle_name');
        if ($request->has('phone')) $manager->phone = $request->request->get('phone');
        if ($request->has('email')) $manager->email = $request->request->get('email');
        $manager->save();
        return $manager;
    }

    private function deleteManager(Request $request) {
        $manager = Managers::find($request->request->getInt('id'));
        if (!$manager) {
            return ['error' => 'Manager not found'];
        }
        $manager->delete();
        return ['status' => 'success'];
    }
}
