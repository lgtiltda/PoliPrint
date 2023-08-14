<?php

if (file_exists("../DAL/NotasDAO.php")) {
    require_once("../DAL/NotasDAO.php");
} else {
    require_once("DAL/NotasDAO.php");
}

class NotasController {

    private $notasDAO;

    public function __construct() {
        $this->notasDAO = new NotasDAO();
    }

        public function Cadastrar($notas) {
        if (1 == 1 ) {
            return $this->notasDAO->Cadastrar($notas);
        } else {
            return false;
        }
    }

    public function Deletar(int $coddeletar) {
        if ($coddeletar != 0) {
            return $this->notasDAO->Deletar($coddeletar);
        } else {
            return false;
        }
    }

    public function RetornarNotas(int $tipo, int $id) {
        if ($tipo > 0 && $id > 0) {
            return $this->notasDAO->RetornarNotas($tipo, $id);
        } else {
            return false;
        }
    }

    public function RetornarNotasDiaMesAno(int $tipo, int $id, int $dia, int $mes, int $ano) {
        if ($id > 0) {
            return $this->notasDAO->RetornarNotasDiaMesAno($tipo, $id, $dia, $mes, $ano);
        } else {
            return false;
        }
    }
    
    public function RetornarNotasDiaMesAnoF(int $tipo, int $id, int $dia, int $mes, int $ano) {
        if ($id > 0) {
            return $this->notasDAO->RetornarNotasDiaMesAnoF($tipo, $id, $dia, $mes, $ano);
        } else {
            return false;
        }
    }

    public function RetornarNotasMesAno(int $tipo, int $id, int $mes, int $ano) {
        if ($tipo > 0 && $id > 0) {
            return $this->notasDAO->RetornarNotasMesAno($tipo, $id, $mes, $ano);
        } else {
            return false;
        }
    }
   
    public function RetornarUltimaNota(int $codfunc) {
        if (1 == 1) {
            return $this->notasDAO->RetornarUltimaNota($codfunc);
        } else {
            return false;
        }
    }
    public function RetornarUltimaNotaFunc(int $cod) {
        if (1 == 1) {
            return $this->notasDAO->RetornarUltimaNotaFunc($cod);
        } else {
            return false;
        }
    }

    public function AlterStatusTodos(int $status, int $id) {
        if (1 == 1) {
            return $this->notasDAO->AlterStatusTodos($status, $id);
        } else {
            echo "erro: <-Controller!";
        }
    }

    public function AlterFunc(int $func, int $cod) {
        if (1 == 1) {
            return $this->notasDAO->AlterFunc($func, $cod);
        } else {
            echo "erro: <-Controller!";
        }
    }

    public function Alterar($notas) {
        if (
                strlen($notas->getNome()) >= 1
        ) {
            return $this->notasDAO->Alterar($notas);
        } else {
            return false;
        }
    }
    public function AlterarNomecli(string $nomecli, int $nota) {
        if ($nota != 0) {
            return $this->notasDAO->AlterarNomecli($nomecli, $nota);
        } else {
            echo "erro: <-Controller!";
        }
    }
    
    public function RetornarFunc(int $cod) {
        if (1 == 1) {
            return $this->notasDAO->RetornarFunc($cod);
        } else {
            echo "erro: <-Controller!";
        }
    }
    
	public function RetornarAtraso(int $cod) {
        if ($cod != 0) {
            return $this->notasDAO->RetornarAtraso($cod);
        } else {
            return null;
        }
    }
    
}
?>