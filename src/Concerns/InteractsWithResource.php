<?php
namespace UiBuilder\Form\Concerns;

trait InteractsWithResource
{
    public function create()
    {
        $this->onCreating();

        $this->resetModel();

        $this->onCreated();
    }

    public function save()
    {
        $this->onSaving();

        $values = $this->values;
        if( !isset( $values['id'] ) )
        {
            $this->store($values);
        }else{
            $this->update($values['id'],$values);
        }

        $this->onSaved();
    }

    public function store(array $values)
    {
        $this->onStoring($values);

        $model = $this->getModel()->create($values);
        $this->setModel($model);

        $this->onStored();
    }

    public function edit($id)
    {
        $this->onEditing();

        $this->values = $this->syncModel($id)
                            ->getModel()
                            ->toArray();

        $this->onEdited();
    }

    public function update($id,array $values)
    {
        $this->onUpdating($values);

        $this->syncModel($id)
            ->getModel()
            ->update($values);

        $this->onUpdated();
    }

    public function destroy($id)
    {
        $this->onDestroying();
        
        $this->syncModel($id)->getModel()->delete();
        $this->resetModel();

        $this->onDestroyed();
    }

    protected function onCreating()
    {

    }

    protected function onCreated()
    {

    }

    protected function onEditing()
    {

    }

    protected function onEdited()
    {

    }

    protected function onSaving()
    {

    }

    protected function onStoring()
    {

    }


    protected function onUpdating()
    {

    }


    protected function onStored()
    {

    }

    protected function onUpdated()
    {

    }

    protected function onSaved()
    {

    }

    protected function onDestroying()
    {

    }

    protected function onDestroyed()
    {
        
    }

}