<?php
namespace App\Providers;

class Validator
{

    private $errors = [];
    private $key;
    private $value;
    private $name;

    public function field($key, $value, $name = null)
    {
        $this->key   = $key;
        $this->value = $value;
        if ($name == null) {
            $this->name = ucfirst($key);
        } else {
            $this->name = ucfirst($name);
        }
        return $this;
    }

    public function required()
    {
        if (empty($this->value)) {
            $this->errors[$this->key] = "$this->name est requis!";
        }
        return $this;
    }

    public function max($length)
    {
        if (strlen($this->value) > $length) {
            $this->errors[$this->key] = "$this->name doit faire maximum $length caractères!";
        }
        return $this;
    }

    public function min($length)
    {
        if (strlen($this->value) < $length) {
            $this->errors[$this->key] = "$this->name doit faire minimum $length caractères!";
        }
        return $this;
    }

    public function uppercase()
    {
        if (! empty($this->value) && ! preg_match('/[A-Z]/', $this->value)) {
            $this->errors[$this->key] = "$this->name ne contient pas de majuscule!";
        }
        return $this;
    }
    public function lowercase()
    {
        if (! empty($this->value) && ! preg_match('/[a-z]/', $this->value)) {
            $this->errors[$this->key] = "$this->name ne contient pas de miniscule!";
        }
        return $this;
    }

    public function countainNumber()
    {
        if (! empty($this->value) && ! preg_match('/[0-9]/', $this->value)) {
            $this->errors[$this->key] = "$this->name ne contient pas de miniscule!";
        }
        return $this;
    }

    public function specialChars()
    {
        if (! empty($this->value) && ! preg_match('/[\@#\$%\^&\*\-_\+=\[\]{};,.]/', $this->value)) {
            $this->errors[$this->key] = "$this->name doit contenir au moins un caractère spécial !";
        }
        return $this;
    }

    public function number()
    {
        if (! empty($this->value) && ! is_numeric($this->value)) {
            $this->errors[$this->key] = "$this->name doit être un nombre!";
        }
        return $this;
    }

    public function email()
    {
        if (! empty($this->value) && ! filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$this->key] = "$this->name est invalide!";
        }
        return $this;
    }

    public function unique($model)
    {
        $model  = 'App\\Models\\' . $model;
        $model  = new $model;
        $unique = $model->unique($this->key, $this->value);
        if ($unique) {
            $this->errors[$this->key] = "$this->name doit être unique.";
        }
        return $this;
    }

    public function isSuccess()
    {
        if (empty($this->errors)) {
            return true;
        }

    }

    public function getErrors()
    {
        if (! $this->isSuccess()) {
            return $this->errors;
        }

    }

    // -- Validateur pour valider l'année

    public function inRange($min, $max)
    {
        if (! empty($this->value) && ($this->value < $min || $this->value > $max)) {
            $this->errors[$this->key] = "$this->name doit être entre $min et $max.";
        }
        return $this;
    }

    public function notSelected()
    {
        if (! isset($this->value) || $this->value === "" || $this->value === "disabled") {
            $this->errors[$this->key] = "$this->name est requis!";
        }
        return $this;
    }

    // Règles de validation des images

    public function checkFileUploaded($file)
    {

        if ($_FILES[$file]["error"] == 4) {
            $this->errors[$this->key] = "$this->name est obligatoire !";
        }
        return $this;
    }

    public function checkImageFormat($file)
    {

        if ($_FILES[$file]["error"] == 0) {

            $fileExtension = strtolower(pathinfo($_FILES[$file]["name"], PATHINFO_EXTENSION));

            if (! in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                $this->errors[$this->key] = "$this->name a un format invalide !";
            }
        } else {

            $this->errors[$this->key] = "$this->name est requis !";
        }

        return $this;
    }

    public function checkIfImage($file)
    {

        if ($_FILES[$file]["error"] != 4) {

            $check = getimagesize($_FILES[$file]["tmp_name"]);
            if ($check === false) {
                $this->errors[$this->key] = "$this->name n'est pas une image!";
            }
        }
        return $this;
    }

    public function checkFileSize($file, $maxSize = 2000000)
    {

        if ($_FILES[$file]["error"] != 4) {

            if ($_FILES[$file]["size"] > $maxSize) {
                $this->errors[$this->key] = "$this->name  fichier dépasse la taille maximale autorisée";
            }
        }
        return $this;
    }

}
