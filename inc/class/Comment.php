<?php
require_once "Model.php";
class Comment extends Model {    
    protected $bdd;
    protected $tablename = "comment";
    
    public function __construct()
    {
            parent::__construct();
    }

    // fonction pour récupérer tous les commentaires
    public function getComments($id)
    {

        $request = "SELECT comment.*, DATE_FORMAT(comment.date, '- %d %m %Y %H:%i -') as date FROM comment INNER JOIN user ON comment.id_user = user.id_user WHERE comment.id_product = :id ORDER BY date DESC";
        // requete
        $select = $this->bdd->prepare($request);
        // execution avec liaison des params
        $select->execute([
            'id' => $id,
        ]);

        // récupération des résultats
        $comments = $select->fetchAll(PDO::FETCH_ASSOC);
        // Si $result produit une erreur, on retourne null
        if (!$comments) {
            return null;
        } else {
            // sinon on retourne le résultat
            return $comments;
        }
    }

    // fonction pour récupérer un commentaire en particulier avec l'auteur et tout ce qui va avec
    public function getComment($id)
    {
        $request = "SELECT comment.*, DATE_FORMAT(comment.date, '- %d %m %Y %H:%i -') as date FROM comment INNER JOIN user ON comment.id_user = user.id_user WHERE comment.id_comment = :id";

        // requete
        $select = $this->bdd->prepare($request);
        // execution avec liaison des params
        $select->execute([
            'id' => $id,
        ]);

        // récupération des résultats
        $comment = $select->fetch(PDO::FETCH_ASSOC);
        // Si $result produit une erreur, on retourne null
        if (!$comment) {
            return null;
        } else {
            // sinon on retourne le résultat
            return $comment;
        }
    }

    // création d'un commentaire lié à l'id de l'article et à l'id de l'utilisateur qui le crée
    public function addComment($subject, $comment, $id_product, $id_user)
    {
        // html special char
        $subject = htmlspecialchars($subject);
        $comment = htmlspecialchars($comment);
        $id_product = htmlspecialchars($id_product);
        $id_user = htmlspecialchars($id_user);

        // requete
        $request = "INSERT INTO comment (subject, comment, date, id_product, id_user) VALUES (:subject, :comment, NOW(), :id_product, :id_user)";

        $insert = $this->bdd->prepare($request);

        // execution avec liaisons des param
        $insert->execute([
            'subject' => $subject,
            'comment' => $comment,
            'id_product' => $id_product,
            'id_user' => $id_user,
        ]);

        // echo "ok" si la requete s'est bien passée
        if ($insert) {
            echo "ok";
        } else {
            echo "erreur";
        }
        $this->bdd = null;
    }

    // fonction pour supprimer un commentaire
    public function deleteComment($id)
    {
        // requête
        $request = "DELETE FROM comment WHERE id = :id";

        $delete = $this->bdd->prepare($request);
        // execution avec liaisons des param
        $delete->execute([
            'id' => $id
        ]);

        // echo "ok" si la requête s'est bien passée
        if ($delete) {
            echo "ok";
        } else {
            echo "erreur";
        }
    }

    // fonction pour modifier un commentaire
    public function updateComment($id, $subject, $comment)
    {
        // html special char
        $subject = htmlspecialchars($subject);
        $comment = htmlspecialchars($comment);

        // requete
        $request = "UPDATE comment SET subject = :subject, comment = :comment WHERE id = :id";

        $update = $this->bdd->prepare($request);

        // execution avec liaisons des param
        $update->execute([
            'subject' => $subject,
            'comment' => $comment,
            'id' => $id,
        ]);

        // echo "ok" si la requete s'est bien passée
        if ($update) {
            echo "ok";
        } else {
            echo "erreur";
        }
    }
}
