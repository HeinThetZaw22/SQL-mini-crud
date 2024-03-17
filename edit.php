<?php include("./template/header.php") ?>
<section class=" max-w-5xl mx-auto p-10">
    <div class="flex gap-3 items-center justify-between">
        <h2 class=" text-2xl font-bold">Create Products</h2>

        <button type="button" class="text-gray-500 p-2 rounded hover:text-gray-600 hover:bg-gray-200" data-hs-overlay="#docs-sidebar" aria-controls="docs-sidebar" aria-label="Toggle navigation">
            <span class="sr-only">Toggle Navigation</span>
            <svg class="flex-shrink-0 size-6" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
            </svg>
        </button>
    </div>
    <?php include("./template/sidebar.php") ?>
    <div class="my-3">
        <ol class="flex items-center whitespace-nowrap p-2 border-y border-gray-200 dark:border-gray-700" aria-label="Breadcrumb">
            <li class="inline-flex items-center">
                <a class="flex items-center text-sm text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 dark:focus:text-blue-500" href="./index.php">
                    <svg class="flex-shrink-0 me-3 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        <polyline points="9 22 9 12 15 12 15 22" />
                    </svg>
                    Home
                </a>
                <svg class="flex-shrink-0 mx-2 overflow-visible size-4 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m9 18 6-6-6-6" />
                </svg>
            </li>
            <li class="inline-flex items-center">
                <a class="flex items-center text-sm text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 dark:focus:text-blue-500" href="./product-create.php">
                    <svg class="flex-shrink-0 me-3 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="7" height="7" x="14" y="3" rx="1" />
                        <path d="M10 21V8a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H3" />
                    </svg>
                    Manage Products
                    <svg class="flex-shrink-0 mx-2 overflow-visible size-4 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m9 18 6-6-6-6" />
                    </svg>
                </a>
            </li>
            <li class="inline-flex items-center text-sm font-semibold text-gray-800 truncate dark:text-gray-200" aria-current="page">
                Edit Product
            </li>
        </ol>
    </div>
    <?php
     $id = $_GET['row_id'];
     $sql = "SELECT * FROM products WHERE id= $id";
     $query = mysqli_query($conn, $sql);
     $row = mysqli_fetch_assoc($query);
    //  print_r($row);
    ?>
    <form action="./update.php" method="post">
        <div class="flex gap-2 my-10">
        <input type="hidden" class="py-3 px-4 block w-full border-gray-200  rounded-lg text-sm" name="row_id" value="<?= $row['id'] ?>">
        <input type="text" class="py-3 px-4 block w-full border-gray-200  rounded-lg text-sm" name="name" value="<?= $row['name'] ?>" required>
        <input type="number" class="py-3 px-4 block w-full border-gray-200  rounded-lg text-sm" name="price" value="<?= $row['price'] ?>" required>
        <input type="number" class="py-3 px-4 block w-full border-gray-200  rounded-lg text-sm" name="stock" value="<?= $row['stock'] ?>" required>
        <button class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none">Update</button>

        </div>
    </form>
    </section>

    <?php include("./template/footer.php") ?>