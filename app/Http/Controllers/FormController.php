<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFormRequest;
use App\Http\Requests\UpdateFormRequest;
use App\Services\FormService;
use Inertia\Inertia;

class FormController extends Controller
{
    protected $formService;

    public function __construct(FormService $formService)
    {
        $this->formService = $formService;
    }

    public function builder()
    {
        $config = $this->formService->getFormConfigurations();

        return Inertia::render('FormBuilder', ['config' => $config]);
    }

    public function index()
    {
        $forms = $this->formService->getForms();

        return Inertia::render('Forms/Index', [
            'forms' => $forms,
        ]);
    }

    public function create(StoreFormRequest $request)
    {
        $validated = $request->validated();
        $this->formService->createForm($validated);

        return redirect()->back()->with('success', 'Form submitted successfully!');
    }

    public function update(UpdateFormRequest $request, $id)
    {
        $validated = $request->validated();
        $form = $this->formService->updateForm($id, $validated);

        // Add a success message
        return back()->with('success', 'Form updated successfully!');
    }

    public function edit($id)
    {
        $config = $this->formService->getFormConfigurations();
        $form = $this->formService->getFormById($id);

        return Inertia::render('Forms/Edit', [
            'form' => [
                'id' => $form->id,
                'title' => $form->title,
                'fields' => $form->fields,
            ],
            'config' => $config,
        ]);
    }

    public function show($id)
    {
        $form = $this->formService->getFormById($id);

        return Inertia::render('Forms/Show', [
            'form' => [
                'id' => $form->id,
                'title' => $form->title,
                'fields' => $form->fields,
            ],
        ]);
    }

    public function destroy($id)
    {
        $this->formService->getFormById($id)->delete();

        return back()->with('success', 'Form deleted successfully!');
    }

    public function userIndex()
    {
        $forms = $this->formService->getUserForms();
        return Inertia::render('Website', [
            'form' => [
                'id' => $forms->id,
                'title' => $forms->title,
                'fields' => $forms->fields,
            ],
        ]);
    }
}
