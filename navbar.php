<nav>
  <ul>
    <li><strong>Article</strong></li>
  </ul>
  <?php if (!isset($_SESSION['user'])) : ?>
    <ul>
      <li><a href="index.php">Accueil</a></li>
      <li><a href="register.php">S'inscrire</a></li>
      <li><a href="login.php">Se connecter</a></li>
    </ul>
  <?php else: ?>
    <ul>
      <li><a href="profil.php">Profil</a></li>
      <li><a href="add_category.php">Ajouter une catégorie</a></li>
      <li><a href="add_article.php">Ajouter un article</a></li>
      <li><a href="logout.php">Se déconnecter</a></li>
    </ul>
  <?php endif; ?>
</nav>