<?php require_once "../templates/header.php" ?>

<div id="container" class="container mt-sm-5">
    <div class="container p-0 mt-3 d-flex">
        <input class="form-control search" id="searchInput" placeholder="Start typing to search or hit Enter..." aria-label="Search">
        <div class="d-flex align-items-center mx-4 filterButton" id="filterButton" data-bs-toggle="collapse" data-bs-target="#filters">
            Filters
            <svg xmlns="http://www.w3.org/2000/svg" height="28" fill="currentColor" class="bi bi-filter ms-2" viewBox="0 0 16 16">
                <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
            </svg>
        </div>
    </div>
    <div class="collapse filters mt-3 float-start" id="filters">
        <div class="float-start me-2">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <button type="button" class="btn btn-primary">Status:</button>
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <span class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="" id="allRadio" checked>
                                <label class="form-check-label" for="allRadio"></label>
                            </div>
                        </span>
                        <span class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="Completed" id="completedRadio">
                                <label class="form-check-label" for="completedRadio">Completed</label>
                            </div>
                        </span>
                        <span class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="Reading" id="readingRadio">
                                <label class="form-check-label" for="readingRadio">Reading</label>
                            </div>
                        </span>
                        <span class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="Plan to Read" id="planToReadRadio">
                                <label class="form-check-label" for="planToReadRadio">Plan to Read</label>
                            </div>
                        </span>
                        <span class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="On-Hold" id="onHoldRadio">
                                <label class="form-check-label" for="onHoldRadio">On-Hold</label>
                            </div>
                        </span>
                        <span class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="Dropped" id="droppedRadio">
                                <label class="form-check-label" for="droppedRadio">Dropped</label>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="float-start me-2">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <button type="button" class="btn btn-primary">Title:</button>
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <span class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="title" value="" id="noneRadio" checked>
                                <label class="form-check-label" for="noneRadio"></label>
                            </div>
                        </span>
                        <span class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="title" value="asc" id="ascRadio">
                                <label class="form-check-label" for="ascendingRadio">Ascending</label>
                            </div>
                        </span>
                        <span class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="title" value="desc" id="descendingRadio">
                                <label class="form-check-label" for="descendingRadio">Descending</label>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="float-end">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <button type="button" class="btn btn-primary">Author:</button>
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" id="dropdown-menu-author">
                        <span class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="author" value="" id="noneAuthor" checked>
                                <label class="form-check-label"></label>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-striped-bordered" id="table">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<script src="js/script.js"></script>

<?php require_once "../templates/footer.php" ?>