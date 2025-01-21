<?php

namespace App\Services;

use App\Models\Form;
use App\Models\FormConfiguration;

class FormService
{
    public function getFormConfigurations()
    {
        return FormConfiguration::first();
    }

    public function getForms($perPage = 10)
    {
        return Form::latest()->paginate($perPage);
    }

    public function getFormById($id)
    {
        return Form::find($id);
    }

    public function updateForm($id, $data)
    {
        $form = Form::find($id);
        if ($form) {
            $form->title = $data['title'];
            $form->fields = $data['fields'];
            $form->save();
        }

        return $form;
    }

    public function createForm($data)
    {
        return Form::create($data);
    }

    public function getUserForms()
    {
        // just show one form client side for demo purposes
        return Form::first();
    }
}
