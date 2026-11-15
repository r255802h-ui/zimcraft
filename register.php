<?php
require "includes/db.php";

$pageTitle = "Register as a Craft Seller";
$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"] ?? "");
    $city = "Harare"; // Always restrict registrations to Harare
    $craft = trim($_POST["craft_type"] ?? "");
    $description = trim($_POST["description"] ?? "");
    $location = trim($_POST["location"] ?? "");
    $hours = trim($_POST["opening_hours"] ?? "");
    $contact = trim($_POST["contact"] ?? "");
    $whatsapp = trim($_POST["whatsapp"] ?? "");
    $icon = trim($_POST["icon"] ?? "🎨");

    $allowedCrafts = [
        "Stone Sculptures",
        "Baskets and Traditional Crafts",
        "Paintings and Handmade Crafts",
        "Wood Carvings"
    ];

    if (
        $name === "" ||
        $craft === "" ||
        $description === "" ||
        $location === "" ||
        $hours === "" ||
        $contact === "" ||
        $whatsapp === ""
    ) {
        $error = "Please complete all the required fields.";

    } elseif (!in_array($craft, $allowedCrafts, true)) {
        $error = "Please select a valid craft type.";

    } else {

        try {
            $sql = "INSERT INTO markets
                (name, city, craft_type, description,
                 location, opening_hours, contact,
                 whatsapp, icon, status)
                VALUES
                (:name, :city, :craft, :description,
                 :location, :hours, :contact,
                 :whatsapp, :icon, 'pending')";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ":name" => $name,
                ":city" => $city,
                ":craft" => $craft,
                ":description" => $description,
                ":location" => $location,
                ":hours" => $hours,
                ":contact" => $contact,
                ":whatsapp" => $whatsapp,
                ":icon" => $icon
            ]);

            $success = "Registration successful! Your listing is awaiting approval.";

            $_POST = [];

        } catch (PDOException $e) {
            $error = "Registration could not be completed. Please try again.";
        }
    }
}

require "includes/header.php";
?>

<section class="page-heading">
    <p class="eyebrow">JOIN THE ZIMCRAFT COMMUNITY</p>

    <h1>Register as a Craft Seller</h1>

    <p>
        Showcase your handmade products to people
        looking for Harare art and crafts.
    </p>
</section>

<section class="container">

    <form class="filter-panel" method="POST"
          action="register.php">

        <?php if ($success): ?>
            <p class="success-message">
                <?php echo htmlspecialchars($success); ?>
            </p>
        <?php endif; ?>

        <?php if ($error): ?>
            <p class="error-message">
                <?php echo htmlspecialchars($error); ?>
            </p>
        <?php endif; ?>

        <label>Seller or Business Name
            <input type="text" name="name"
                value="<?php echo htmlspecialchars($_POST["name"] ?? ""); ?>"
                required>
        </label>

        <label>City
            <input type="text" value="Harare" readonly>
        </label>

        <label>Craft Type
            <select name="craft_type" required>
                <option value="">Choose craft type</option>

                <?php
                $craftOptions = [
                    "Stone Sculptures",
                    "Baskets and Traditional Crafts",
                    "Paintings and Handmade Crafts",
                    "Wood Carvings"
                ];

                foreach ($craftOptions as $option):
                ?>
                    <option value="<?php echo htmlspecialchars($option); ?>"
                        <?php echo (($_POST["craft_type"] ?? "") === $option) ? "selected" : ""; ?>>
                        <?php echo htmlspecialchars($option); ?>
                    </option>
                <?php endforeach; ?>

            </select>
        </label>

        <label>About Your Crafts
            <textarea name="description" required><?php
                echo htmlspecialchars($_POST["description"] ?? "");
            ?></textarea>
        </label>

        <label>Physical Selling Location in Harare
            <input type="text" name="location"
                value="<?php echo htmlspecialchars($_POST["location"] ?? ""); ?>"
                required>
        </label>

        <label>Opening Hours
            <input type="text" name="opening_hours"
                value="<?php echo htmlspecialchars($_POST["opening_hours"] ?? ""); ?>"
                placeholder="Monday-Saturday, 8AM-5PM"
                required>
        </label>

        <label>Phone Number
            <input type="tel" name="contact"
                value="<?php echo htmlspecialchars($_POST["contact"] ?? ""); ?>"
                placeholder="0712345678" required>
        </label>

        <label>WhatsApp Number
            <input type="tel" name="whatsapp"
                value="<?php echo htmlspecialchars($_POST["whatsapp"] ?? ""); ?>"
                placeholder="0712345678" required>
        </label>

        <label>Craft Icon (Emoji)
            <input type="text" name="icon"
                value="<?php echo htmlspecialchars($_POST["icon"] ?? "🎨"); ?>"
                maxlength="10">
        </label>

        <button class="button" type="submit">
            Submit Registration
        </button>

    </form>

</section>

<?php require "includes/footer.php"; ?>