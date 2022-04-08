<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Session;

trait FeedBack
{
    public function redirectStoreSuccess(
        string $path,
        string $type = 'alert-success',
        string $msg = 'Parabéns, cadastro realizado com sucesso 🥳'
    ) {
        return redirect()->route($path)->with(Session::flash($type, $msg));
    }

    public function redirectUpdatedSuccess(
        string $path,
        string $type = 'alert-success',
        string $msg = 'Dados atualizados com sucesso 🥳'
    ) {
        return redirect()->route($path)->with(Session::flash($type, $msg));
    }

    public function redirectNotFound(
        string $path,
        string $type = 'alert-danger',
        string $msg = 'Ops!, desculpe não existe registro 🙁'
    ) {
        return redirect()->route($path)->with(Session::flash($type, $msg));
    }

    public function redirectRemovedSuccess(
        string $path,
        string $type = 'alert-success',
        string $msg = 'Registro excluido com sucesso 👍'
    ) {
        return redirect()->route($path)->with(Session::flash($type, $msg));
    }
}
