<?php
session_start();

// Default settings
$settings = [
    'site_name' => 'Admin Panel',
    'timezone' => 'UTC',
    'maintenance_mode' => false,
    'logo_path' => '../assets/logo.png'
];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $settings['site_name'] = htmlspecialchars(trim($_POST['site_name']));
    $settings['timezone'] = in_array($_POST['timezone'], DateTimeZone::listIdentifiers()) ? $_POST['timezone'] : 'UTC';
    $settings['maintenance_mode'] = isset($_POST['maintenance_mode']) ? true : false;
    
    $success_message = "Settings updated successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title><?php echo htmlspecialchars($settings['site_name']); ?> - Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #f8f9fc;
        }
        
        .sidebar {
            background-color: #2c3e50;
            color: white;
            height: 100vh;
            width: 250px;
            padding: 0;
            position: fixed;
        }
        
        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
        }
        
        .card {
            border: none;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            margin-bottom: 2rem;
        }
        
        .card-header {
            background-color: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
            font-weight: 700;
        }
        
        .form-section {
            margin-bottom: 2.5rem;
        }
        
        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #4e73df;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #e3e6f0;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .main-content {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar - Left as is per request -->
        <div class="sidebar">
            <?php include '../includes/sidebar.php'; ?>
        </div>

        <!-- Main Content -->
        <main class="main-content">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2"><i class="fas fa-cog me-2"></i>System Settings</h1>
            </div>

            <!-- Success Message -->
            <?php if (isset($success_message)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $success_message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Settings Form -->
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-wrench me-2"></i>General Settings</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-section">
                            <h6 class="section-title"><i class="fas fa-info-circle me-2"></i>Site Information</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="site_name" class="form-label">Site Name</label>
                                    <input type="text" class="form-control" id="site_name" name="site_name" 
                                           value="<?php echo htmlspecialchars($settings['site_name']); ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="timezone" class="form-label">Timezone</label>
                                    <select class="form-select" id="timezone" name="timezone">
                                        <?php foreach (DateTimeZone::listIdentifiers() as $tz): ?>
                                            <option value="<?php echo $tz; ?>" <?php echo $settings['timezone'] === $tz ? 'selected' : ''; ?>>
                                                <?php echo $tz; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <h6 class="section-title"><i class="fas fa-tools me-2"></i>System Settings</h6>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="maintenance_mode" name="maintenance_mode" 
                                       <?php echo $settings['maintenance_mode'] ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="maintenance_mode">Maintenance Mode</label>
                                <small class="text-muted d-block">When enabled, only administrators can access the site.</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-2"></i>Save Settings
                        </button>
                    </div>
                </div>
            </form>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Confirm before leaving unsaved changes
        let formChanged = false;
        const form = document.querySelector('form');
        const inputs = form.querySelectorAll('input, select, textarea');
        
        inputs.forEach(input => {
            input.addEventListener('change', () => formChanged = true);
        });
        
        window.addEventListener('beforeunload', (e) => {
            if (formChanged) {
                e.preventDefault();
                e.returnValue = 'You have unsaved changes. Are you sure you want to leave?';
            }
        });
        
        form.addEventListener('submit', () => formChanged = false);
    </script>
</body>
</html>