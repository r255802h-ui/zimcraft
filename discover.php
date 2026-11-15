<?php
require_once "includes/db.php";

$pageTitle = "Discover Harare Craft Sellers";

$craft = trim($_GET["craft"] ?? "");

// Get craft types from approved Harare sellers only
$craftSql = "SELECT DISTINCT craft_type
             FROM markets
             WHERE city = :city
             AND status = 'approved'
             AND craft_type IS NOT NULL
             AND craft_type != ''
             ORDER BY craft_type";

$craftStmt = $pdo->prepare($craftSql);
$craftStmt->execute([":city" => "Harare"]);
$craftTypes = $craftStmt->fetchAll(PDO::FETCH_COLUMN);

// Get approved craft sellers in Harare
$sql = "SELECT * FROM markets
        WHERE city = :city
        AND status = 'approved'";

$params = [":city" => "Harare"];

if ($craft !== "" && in_array($craft, $craftTypes, true)) {
    $sql .= " AND craft_type = :craft";
    $params[":craft"] = $craft;
}

$sql .= " ORDER BY name";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$markets = $stmt->fetchAll(PDO::FETCH_ASSOC);

require "includes/header.php";
?>

<section class="page-heading">
    <p class="eyebrow">EXPLORE HARARE'S CREATIVE SIDE</p>

    <h1>Discover Local Art in Harare</h1>

    <p>
        Discover talented independent craft sellers around Harare.
        Explore beautiful stone sculptures, wooden carvings,
        traditional baskets and handmade artwork.
    </p>
</section>

<form class="filter-panel" method="GET" action="discover.php">

    <label for="craft">Choose a craft</label>

    <select name="craft" id="craft">
        <option value="">All craft types</option>

        <?php foreach ($craftTypes as $craftName): ?>
            <option
                value="<?php echo htmlspecialchars($craftName); ?>"
                <?php echo $craft === $craftName ? "selected" : ""; ?>
            >
                <?php echo htmlspecialchars($craftName); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button class="button" type="submit">
        Apply Filters
    </button>

    <a class="reset-link" href="discover.php">
        Clear Filters
    </a>

</form>

<section class="market-grid">

    <?php if (count($markets) > 0): ?>

        <?php foreach ($markets as $market): ?>

            <article class="market-card">

                <?php if (!empty($market["image"])): ?>
                    <img
                        src="assets/<?php echo htmlspecialchars($market["image"]); ?>"
                        alt="<?php echo htmlspecialchars($market["name"]); ?>"
                        style="width:100%; height:220px; object-fit:cover; border-radius:12px;"
                    >
                <?php endif; ?>

                <div class="market-icon">
                    <?php echo htmlspecialchars($market["icon"] ?? "🎨"); ?>
                </div>

                <p class="card-location">
                    📍 <?php echo htmlspecialchars($market["location"] ?? "Harare, Zimbabwe"); ?>
                </p>

                <h2>
                    <?php echo htmlspecialchars($market["name"]); ?>
                </h2>

                <p>
                    <?php echo htmlspecialchars($market["description"]); ?>
                </p>

                <div class="tag">
                    <?php echo htmlspecialchars($market["craft_type"]); ?>
                </div>

                <a class="text-link"
                   href="market.php?id=<?php echo (int)$market["id"]; ?>">
                    View Seller Details →
                </a>

            </article>

        <?php endforeach; ?>

    <?php else: ?>

        <div class="empty-state">
            <h2>No craft sellers found</h2>

            <p>
                Try selecting another craft type or clearing
                your filters to see all approved Harare craft sellers.
            </p>
        </div>

    <?php endif; ?>

</section>

<?php require "includes/footer.php"; ?>