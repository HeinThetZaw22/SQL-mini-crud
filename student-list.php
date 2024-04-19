<?php include("./template/header.php") ?>
<?php
$recordPerPage = 5;

$sql = "SELECT *, students.id as student_id FROM students LEFT JOIN nationality ON nationality.id = students.nationality_id LEFT JOIN gender ON gender.id = students.gender_id";
$countSql = "SELECT count(id) as total FROM students";
if (isset($_GET["q"])) {
    $q = $_GET["q"];
    $sql .= " WHERE name LIKE '%$q%'";
    $countSql .= " WHERE name LIKE '%$q%'";
}
if (isset($_GET["sort_by"]) & isset($_GET["order"])) {
    $sort = $_GET["sort_by"];
    $order = $_GET["order"];
    $sql .= " ORDER BY $sort $order";
}

$countQuery = mysqli_query($conn, $countSql);
$countResult = mysqli_fetch_assoc($countQuery);
$totalRecord = $countResult["total"];

$totalPage = $totalRecord / $recordPerPage;
$currentPage = isset($_GET["page"]) ? $_GET["page"] : 1;
$offset = ($currentPage - 1) * $recordPerPage;
$sql .= " LIMIT $offset,$recordPerPage";

$query = mysqli_query($conn, $sql);
// print_r($query);

?>
<section class=" max-w-5xl mx-auto p-10">
    <div class="flex gap-3 items-center justify-between">
        <h2 class=" text-2xl font-bold">Create students</h2>

        <button type="button" class="text-gray-500 p-2 rounded hover:text-gray-600 hover:bg-gray-200" data-hs-overlay="#docs-sidebar" aria-controls="docs-sidebar" aria-label="Toggle navigation">
            <span class="sr-only">Toggle Navigation</span>
            <svg class="flex-shrink-0 size-6" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
            </svg>
        </button>
    </div>
    <?php include("./template/sidebar.php") ?>

    <div class="mt-3">
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

            <li class="inline-flex items-center text-sm font-semibold text-gray-800 truncate dark:text-gray-200" aria-current="page">

                <a class="flex items-center text-sm text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 dark:focus:text-blue-500" href="#">
                    Manage students
                </a>
            </li>
        </ol>
    </div>
    <!-- <form action="" method="post">
        <div class="flex gap-2 my-10">
            <input type="text" class="py-3 px-4 block w-full border-gray-200  rounded-lg text-sm" name="name" placeholder="name" required>
            <input type="number" class="py-3 px-4 block w-full border-gray-200  rounded-lg text-sm" name="price" placeholder="price" required>
            <input type="number" class="py-3 px-4 block w-full border-gray-200  rounded-lg text-sm" name="stock" placeholder="quantity" required>
            <button class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none">Add</button>
        </div>
    </form> -->
    <div class="flex justify-between items-center my-5">
        <div>
            <button type="button" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-blue-600 text-blue-600 hover:border-blue-500 hover:text-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:border-blue-500 dark:text-blue-500 dark:hover:text-blue-400 dark:hover:border-blue-400">
                Create Student
            </button>
            <button type="button" class="py-3 px-2 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg  text-blue-600 hover:border-blue-500 hover:text-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:border-blue-500 dark:text-blue-500 dark:hover:text-blue-400 dark:hover:border-blue-400">
                Sort <?= strtoupper($_GET["order"]) ?>
                <a href="./student-list.php?sort_by=name&order=asc">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class=" size-6 border rounded-lg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                    </svg>
                </a>
                <a href="./student-list.php?sort_by=name&order=desc">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 border rounded-lg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
                    </svg>
                </a>


            </button>
            <?php if (isset($_GET["sort_by"])) : ?>

                <a href="./student-list.php">
                    <button type="button" class="py-1.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-100 text-red-800 hover:bg-red-200 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-red-900 dark:text-red-500 dark:hover:text-red-400">
                        Clear Sort
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class=" size-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>

                    </button>
                </a>


            <?php endif ?>
        </div>
        <form action="./student-list.php" method="GET">
            <div>
                <label for="hs-trailing-button-add-on-with-icon" class="sr-only">Label</label>
                <div class="flex rounded-lg shadow-sm">
                    <input value="<?= isset($_GET["q"]) ? $_GET["q"] : '' ?>" required type="text" name="q" id="hs-trailing-button-add-on-with-icon" name="hs-trailing-button-add-on-with-icon" class="py-2 px-4 block w-full border-gray-200 shadow-sm rounded-s-lg text-sm focus:z-10  focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                    <button type="submit" class="w-[2.875rem] h-[2.875rem] flex-shrink-0 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-e-md border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.3-4.3"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="flex justify-end items-center gap-2  mb-2">
        <p>Showing results (<?= $totalRecord ?>)
        </p>
        <?php if (isset($_GET["q"])) : ?>

            : searched by '<?= $_GET["q"] ?>'
            <a href="./student-list.php">
                <button type="button" class="py-1.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-100 text-red-800 hover:bg-red-200 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-red-900 dark:text-red-500 dark:hover:text-red-400">
                    Clear
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class=" size-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>

                </button>
            </a>


        <?php endif ?>
    </div>
    <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">#</th>
                                <th scope="col" class=" py-3 text-start text-xs font-medium text-gray-500 uppercase">Name</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Date of Birth</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">nationality_id</th>
                                <th scope="col" class="px-6 py-3  text-xs font-medium text-gray-500 text-start uppercase">created_at</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($query)) :
                            ?>
                                <tr class="odd:bg-white even:bg-gray-100 dark:odd:bg-slate-900 dark:even:bg-slate-800">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200"><?= $row["student_id"] ?>

                                    </td>
                                    <td class=" py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200"><?= $row["name"] ?>
                                        <br><span class=" text-xs bg-gray-300 text-gray-600 rounded-full px-2 py-1"><?= $row["type"] ?></span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200"><?= date("d M Y", strtotime($row["date_of_birth"])) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200"><?= $row["nation"] ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-endfont-medium text-gray-800 dark:text-gray-200"><?= date("d M Y", strtotime($row["created_at"])) ?><br>
                                        <?= date("h : i A", strtotime($row["date_of_birth"])) ?>
                                    </td>
                                    <td class=" py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">

                                        <div class="inline-flex rounded-lg shadow-sm">
                                            <a href="./product-edit.php?row_id=<?= $row['id'] ?>" class="py-3 px-4 inline-flex items-center gap-x-2 -ms-px first:rounded-s-lg first:ms-0 last:rounded-e-lg text-sm font-medium focus:z-10 border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none ">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>

                                            </a>
                                            <a onclick="return confirm('Are u sure?')" href="./product-delete.php?row_id=<?= $row['id'] ?>" class="py-3 px-4 inline-flex items-center gap-x-2 -ms-px first:rounded-s-lg first:ms-0 last:rounded-e-lg text-sm font-medium focus:z-10 border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>

                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile ?>
                            <?php if ($query->num_rows == 0) : ?>
                                <tr>
                                    <td colspan="6" class=" font-medium rounded bg-gray-100 text-center py-3">There is no results</td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>
    <?php
    $start = $currentPage > 3 ?  $currentPage - 3 : 1;
    $end = $currentPage + 3 < $totalPage ? $currentPage + 3 : $totalPage;
    ?>
    <!-- Pagination -->
    <nav class="flex justify-center items-center bg-gray-100 py-1 mt-3 gap-x-1">
        <?php if ($currentPage - 1 > 0) : ?>
            <a href="./student-list.php?page=<?= $currentPage - 1 ?>&<?= isset($_GET["q"]) ? "q=" . $_GET["q"] : "" ?>" class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-2 text-sm rounded-lg border border-transparent text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:border-transparent dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                <svg class="flex-shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m15 18-6-6 6-6"></path>
                </svg>
                <span aria-hidden="true" class="sr-only">Previous</span>
            </a>
        <?php endif ?>
        <div class="flex items-center gap-x-1">
            <?php for ($i = $start; $i <= $end; $i++) : ?>
                <a href="./student-list.php?page=<?= $i ?>&<?= isset($_GET["q"]) ? "q=" . $_GET["q"] : "" ?>" class="min-h-[38px] min-w-[38px] flex justify-center items-center <?= $i == $currentPage ? "border bg-gray-200 border-gray-200" : "" ?>  text-gray-800 py-2 px-3 text-sm rounded-lg focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:border-neutral-700 dark:text-white dark:focus:bg-white/10" aria-current="page">
                    <?= $i ?>
                </a>
            <?php endfor ?>
        </div>
        <?php if ($currentPage + 1 < $totalPage) : ?>
            <a href="./student-list.php?page=<?= $currentPage + 1 ?>&<?= isset($_GET["q"]) ? "q=" . $_GET["q"] : "" ?>" class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-2 text-sm rounded-lg border border-transparent text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:border-transparent dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                <span aria-hidden="true" class="sr-only">Next</span>
                <svg class="flemin-h-[38px] min-w-[38px]x-shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m9 18 6-6-6-6"></path>
                </svg>
            </a>
        <?php endif ?>
    </nav>
    <!-- End Pagination -->
</section>
<?php include("./template/footer.php") ?>