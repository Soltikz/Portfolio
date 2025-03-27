<?php
$info = $bdd->query("SELECT * FROM production");
$productions = $info->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="production">
    <div class="title-prod">
        <p>01.</p>
        <h2>
            <?=$translations['produc'] ?? 'Productions'?>
        </h2>
    </div>
    <div class="content-produc">
        <div class="accordeons">
            <?php
            // Boucle pour afficher chaque production
            foreach ($productions as $index => $production) {
                // Assurer que l'index commence à 1 et est utilisé pour la classe de l'accordéon
                $accordionClass = 'produc' . ($index + 1);
            ?>
            <div class="produc back">
                <div class="date">
                    <p><?=$production['date']?></p>
                </div>
                <div class="info">
                    <p><?=$production['name']?></p>
                </div>
                <div>
                    <div class="arrow-right">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14" />
                            <path d="m12 5 7 7-7 7" />
                        </svg>
                    </div>
                    <div class="arrow-up">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M7 7h10v10" />
                            <path d="M7 17 17 7" />
                        </svg>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

        <div class="preview-all">
            <?php
            // Boucle pour afficher les aperçus des productions
            foreach ($productions as $production) {
            ?>
            <div class="preview">
                <img src="<?=$production['image']?>" alt="<?=$production['alt']?>">
                <div class="info-pre">
                    <h3><?=$production['name']?></h3>
                    <p><?=$production['description']?></p>
                    <a href="project.php?name=<?= urlencode($production['name']) ?>">
                        <?=$translations['Discover the project'] ?? 'Découvrir le projet'?>
                    </a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>