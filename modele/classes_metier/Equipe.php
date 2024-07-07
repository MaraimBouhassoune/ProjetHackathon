<?php

class Equipe
{
    private int $idEquipe;
    private string $nomEquipe;
    private ?string $lienProjetEquipe;
    private ?int $noteProjetEquipe;
    private ?int $classementEquipe;
    private int $idParticipantChef;
    private int $idProjet;

    public function __construct()
    {
        $this->idEquipe = 0; // Initialisation à 0, sera défini par la base de données lors de l'insertion
        $this->nomEquipe = "";
        $this->lienProjetEquipe = null;
        $this->noteProjetEquipe = null;
        $this->classementEquipe = null;
        $this->idParticipantChef = 0;
        $this->idProjet = 0;
    }

    // Getters
    public function getIdEquipe(): int
    {
        return $this->idEquipe;
    }

    public function getNomEquipe(): string
    {
        return $this->nomEquipe;
    }

    public function getLienProjetEquipe(): ?string
    {
        return $this->lienProjetEquipe;
    }

    public function getNoteProjetEquipe(): ?int
    {
        return $this->noteProjetEquipe;
    }

    public function getClassementEquipe(): ?int
    {
        return $this->classementEquipe;
    }

    public function getIdParticipantChef(): int
    {
        return $this->idParticipantChef;
    }

    public function getIdProjet(): int
    {
        return $this->idProjet;
    }

    // Setters
    public function setNomEquipe(string $nomEquipe): void
    {
        $this->nomEquipe = $nomEquipe;
    }

    public function setLienProjetEquipe(?string $lienProjetEquipe): void
    {
        $this->lienProjetEquipe = $lienProjetEquipe;
    }

    public function setNoteProjetEquipe(?int $noteProjetEquipe): void
    {
        $this->noteProjetEquipe = $noteProjetEquipe;
    }

    public function setClassementEquipe(?int $classementEquipe): void
    {
        $this->classementEquipe = $classementEquipe;
    }

    public function setIdParticipantChef(int $idParticipantChef): void
    {
        $this->idParticipantChef = $idParticipantChef;
    }

    public function setIdProjet(int $idProjet): void
    {
        $this->idProjet = $idProjet;
    }

    // Ajoutez ici d'autres méthodes pour interagir avec la base de données, comme sauvegarder une équipe, récupérer les équipes, etc.
}

?>
