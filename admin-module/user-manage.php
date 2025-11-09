<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
</head>
<body class="bg-black text-white">

    <?php
        include('../component/config.php');
        include('../component/function.php');
        include('../component/nav-admin.php');

        // Ambil semua user dari DB
        $stmt = $pdo->query("SELECT * FROM user ORDER BY user_id DESC");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="container max-w-full min-h-screen p-6">

        <h1 class="text-4xl font-bold text-center mb-10 text-teal-300">Manage Users</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-700 rounded-xl overflow-hidden">
                <thead class="bg-neutral-900">
                    <tr>
                        <th class="border border-gray-700 px-4 py-2 text-left">No</th>
                        <th class="border border-gray-700 px-4 py-2 text-left">Name</th>
                        <th class="border border-gray-700 px-4 py-2 text-left">Email</th>
                        <th class="border border-gray-700 px-4 py-2 text-left">Phone Number</th>
                        <th class="border border-gray-700 px-4 py-2 text-left">Role</th>
                        <th class="border border-gray-700 px-4 py-2 text-left">Status</th>
                        <th class="border border-gray-700 px-4 py-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        foreach ($users as $user) {
                            $statusClass = $user['status'] === 'active' ? 'text-green-400' : 'text-red-400';
                            $statusText = ucfirst($user['status']);
                    ?>
                    <tr class="odd:bg-neutral-950 even:bg-neutral-800 hover:bg-neutral-700 transition">
                        <td class="border border-gray-700 px-4 py-2"><?php echo $no++; ?></td>
                        <td class="border border-gray-700 px-4 py-2"><?php echo htmlspecialchars($user['name']); ?></td>
                        <td class="border border-gray-700 px-4 py-2"><?php echo htmlspecialchars($user['email']); ?></td>
                        <td class="border border-gray-700 px-4 py-2"><?php echo htmlspecialchars($user['phone_number']); ?></td>
                        <td class="border border-gray-700 px-4 py-2 capitalize"><?php echo htmlspecialchars($user['user_type']); ?></td>
                        <td class="border border-gray-700 px-4 py-2 capitalize font-semibold <?php echo $statusClass; ?>">
                            <?php echo $statusText; ?>
                        </td>
                        <td class="border border-gray-700 px-4 py-2 text-center">
                            <a href="user-edit.php?id=<?php echo $user['user_id']; ?>" class="bg-neutral-900 hover:bg-neutral-800 px-3 py-1 rounded-lg mr-2">Edit</a>
                            
                            <form action="user-status.php" method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $user['user_id']; ?>">
                                <input type="hidden" name="status" value="<?php echo $user['status']; ?>">

                                <?php if ($user['status'] === 'active') { ?>
                                    <button type="submit" name="suspend" class="bg-yellow-400 text-black hover:bg-yellow-500 px-3 py-1 rounded-lg font-semibold cursor-pointer">
                                        Suspend
                                    </button>
                                <?php } else { ?>
                                    <button type="submit" name="activate" class="bg-green-400 text-black hover:bg-green-500 px-3 py-1 rounded-lg font-semibold cursor-pointer">
                                        Activate
                                    </button>
                                <?php } ?>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>
