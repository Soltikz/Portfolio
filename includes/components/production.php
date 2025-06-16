<?php
$info = $bdd->query("SELECT * FROM production");
$productions = $info->fetchAll(PDO::FETCH_ASSOC);
// Récupérer les dates uniques triées
$datesQuery = $bdd->query("SELECT DISTINCT date FROM production ORDER BY date DESC");
$dates = $datesQuery->fetchAll(PDO::FETCH_COLUMN);
?>
<div class="production">
    <div class="title-prod">
        <p>01.</p>
        <h2><?= $translations['produc'] ?? 'Productions' ?></h2>
    </div>

    <!-- Switch pour changer de mode -->
    <div class="filtre">
        <div class="mode-switch">
            <label class="switch">
                <input type="checkbox" id="mode-toggle">
                <span class="slider"></span>
            </label>
            <span id="mode-label">Professionnel</span>
        </div>
    </div>

    <div class="content-produc">
        <div class="accordeons">
            <?php foreach ($productions as $index => $production): ?>
            <div class="produc back" data-type="<?= strtolower(trim($production['ac_pro'])) ?>">
                <div class="date">
                    <p><?= htmlspecialchars($production['date']) ?></p>
                </div>
                <div class="info">
                    <p><?= htmlspecialchars($production['name']) ?></p>
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
            <?php endforeach; ?>
        </div>

        <div class="preview-all">
            <?php foreach ($productions as $production): ?>
            <div class="preview" data-type="<?= strtolower(trim($production['ac_pro'])) ?>" style="display:none;">
                <img src="<?= htmlspecialchars($production['image']) ?>" alt="image projet">
                <div class="info-pre">
                    <h3><?= htmlspecialchars($production['name']) ?></h3>
                    <p><?= mb_strlen($production['description']) > 150
                            ? mb_substr($production['description'], 0, 150) . '...'
                            : htmlspecialchars($production['description']); ?>
                    </p>
                    <a
                        href="project.php?name=<?= urlencode($production['name']) ?>&mode=<?= $_GET['mode'] ?? 'professionnel' ?>">
                        <?= $translations['Discover the project'] ?? 'Découvrir le projet' ?>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const toggle = document.getElementById("mode-toggle");
    const label = document.getElementById("mode-label");

    // Lire le mode actuel dans l'URL ou défaut à "professionnel"
    const urlParams = new URLSearchParams(window.location.search);
    const currentMode = urlParams.get("mode") || "professionnel";

    // Appliquer l'état du switch
    toggle.checked = currentMode === "academique";
    label.textContent = toggle.checked ? "Académique" : "Professionnel";

    // Appliquer dynamiquement le mode dans tous les liens
    document.querySelectorAll('.preview a').forEach(link => {
        const url = new URL(link.href);
        url.searchParams.set('mode', currentMode);
        link.href = url.toString();
    });

    // Gérer le changement de mode
    toggle.addEventListener("change", () => {
        const newMode = toggle.checked ? "academique" : "professionnel";
        const newUrl = new URL(window.location.href);
        newUrl.searchParams.set("mode", newMode);
        window.location.href = newUrl.toString();
    });
});
</script>