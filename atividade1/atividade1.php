//PRIMEIRO EXEMPLO

public function handle(Request $request, $isNew, $fieldId, $fieldName, $data)
    {
        $sessionUser = session('user');
        $cpfUser = Arr::get($sessionUser, 'cpf');
        $userIsProfessional = Profissional::where('cpf', 'like', $cpfUser)->count();

	// ERRADO
	if ($cpfUser) {
            $userIsProfessional = Profissional::where('cpf', 'like', $cpfUser)->count();
            if ($userIsProfessional === 0) {
                throw new ValidationException(null, null, "Usuário logado não é um profissional!");
            }
        } else {
            throw new ValidationException(null, null, "Usuário logado sem CPF cadastrado!");
        }

	// CERTO

        if (is_null($cpfUser)) throw new ValidationException(null, null, "Usuário logado sem CPF cadastrado!");

        if (!$userIsProfessional) {
            throw new ValidationException(null, null, "Usuário logado não é um profissional!");
        }

}

//O SEGUNDO EXEMPLO NÃO ADICIONEI PORQUE FAZ PARTE DE MAIS DE UM ARQUIVO, MAS ESTÁ SENDO EXPLICADO NO VÍDEO
