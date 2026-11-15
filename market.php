<?php
require "includes/db.php";

$pageTitle = "Craft Seller Details";

// Get seller ID from URL
$id = isset($_GET["id"]) ? (int) $_GET["id"] : 0;

// Find approved seller in Harare only
$stmt = $pdo->prepare(
    "SELECT * FROM markets
     WHERE id = :id
     AND city = :city
     AND status = 'approved'"
);

$stmt->execute([
    ":id" => $id,
    ":city" => "Harare"
]);

$market = $stmt->fetch(PDO::FETCH_ASSOC);

// Prepare phone number
$phone = "";
$whatsapp = "";

if ($market) {

    $phone = preg_replace('/\D+/', '', $market["contact"] ?? "");

    if ($phone !== "" && substr($phone, 0, 1) === "0") {
        $phone = "263" . substr($phone, 1);
    } elseif (
        $phone !== "" &&
        substr($phone, 0, 3) !== "263"
    ) {
        $phone = "263" . $phone;
    }

    // Use WhatsApp number, or phone number if WhatsApp is not provided
    $whatsappNumber = !empty($market["whatsapp"])
        ? $market["whatsapp"]
        : ($market["contact"] ?? "");

    $whatsapp = preg_replace('/\D+/', '', $whatsappNumber);

    if ($whatsapp !== "" && substr($whatsapp, 0, 1) === "0") {
        $whatsapp = "263" . substr($whatsapp, 1);
    } elseif (
        $whatsapp !== "" &&
        substr($whatsapp, 0, 3) !== "263"
    ) {
        $whatsapp = "263" . $whatsapp;
    }
}

require "includes/header.php";
?>

<section class="page-heading">
    <p class="eyebrow">ZIMCRAFT • HARARE</p>

    <h1>Meet the Craft Sellers</h1>

    <p>
        Discover the people, creativity and stories
        behind Harare's handmade artwork.
    </p>
</section>

<section class="container">

<?php if ($market): ?>

    <div class="market-card">

        <?php if (!empty($market["image"])): ?>
            <img
                src="assets/<?php echo htmlspecialchars($market["image"]); ?>"
                alt="<?php echo htmlspecialchars($market["name"]); ?>"
                style="width:100%; max-height:400px; object-fit:cover; border-radius:12px; margin-bottom:20px;"
            >
        <?php endif; ?>

        <div class="market-icon">
            <?php echo htmlspecialchars($market["icon"] ?? "🎨"); ?>
        </div>

        <h2>
            <?php echo htmlspecialchars($market["name"]); ?>
        </h2>

        <div class="seller-information">

            <p>
                <strong>Craft Type:</strong><br>
                <?php echo htmlspecialchars($market["craft_type"] ?? "Not provided"); ?>
            </p>

            <p>
                <strong>About the Crafts:</strong><br>
                <?php echo nl2br(htmlspecialchars($market["description"] ?? "Not provided")); ?>
            </p>

            <p>
                <strong>Physical Selling Location:</strong><br>
                📍 <?php echo htmlspecialchars($market["location"] ?? "Not provided"); ?>
            </p>

            <p>
                <strong>Opening Hours:</strong><br>
                <?php echo htmlspecialchars($market["opening_hours"] ?? "Not provided"); ?>
            </p>

            <p>
                <strong>Phone Number:</strong><br>

                <?php if ($phone !== ""): ?>
                    <a href="tel:+<?php echo htmlspecialchars($phone); ?>">
                        <?php echo htmlspecialchars($market["contact"]); ?>
                    </a>
                <?php else: ?>
                    Phone number not available.
                <?php endif; ?>
            </p>

            <?php if ($phone !== "" || $whatsapp !== ""): ?>

                <div class="contact-buttons">

                    <?php if ($phone !== ""): ?>
                        <a class="button"
                           href="tel:+<?php echo htmlspecialchars($phone); ?>">
                            📞 Call Seller
                        </a>
                    <?php endif; ?>

                    <?php if ($whatsapp !== ""): ?>
                        <a class="button"
                           href="https://wa.me/<?php echo htmlspecialchars($whatsapp); ?>"
                           target="_blank"
                           rel="noopener noreferrer">
                            💬 WhatsApp Seller
                        </a>
                    <?php endif; ?>

                </div>

            <?php endif; ?>

        </div>

    </div>

<?php else: ?>

    <div class="empty-state">

        <h2>Seller Not Found</h2>

        <p>
            Sorry, we could not find this approved craft seller
            in our Harare directory.
        </p>

        <a href="discover.php" class="button">
            Return to Discover
        </a>

    </div>

<?php endif; ?>

</section>

<?php require "includes/footer.php"; ?>