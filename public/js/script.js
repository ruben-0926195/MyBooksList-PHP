document.addEventListener("DOMContentLoaded", function () {
  const tableBody = document.querySelector("#table tbody");

  let checkboxes = document.querySelectorAll('input[type="radio"]');
  let = checkboxesStatus = document.querySelectorAll(
    'input[type="radio"][name="status"]'
  );
  let checkboxesTitle = document.querySelectorAll(
    'input[type="radio"][name="title"]'
  );
  let checkboxesAuthor = document.querySelectorAll(
    'input[type="radio"][name="author"]'
  );

  function displayBooks(data) {
    for (const entry of data.postData) {
      const newRow = document.createElement("tr");

      const imgCell = document.createElement("td");
      newRow.appendChild(imgCell);

      const img = document.createElement("img");
      img.src = entry.image;
      img.style = "width: 4rem";
      img.classList = "card-img-top";
      img.loading = "lazy";
      imgCell.appendChild(img);

      const titleCell = document.createElement("td");
      newRow.appendChild(titleCell);

      const link = document.createElement("a");
      link.classList = "text-decoration-none";
      link.href = window.location.href + `book?book=${entry.id}`;
      titleCell.appendChild(link);

      const linkTitle = document.createElement("h6");
      linkTitle.textContent = entry.title;
      link.appendChild(linkTitle);

      const statusCell = document.createElement("td");
      newRow.appendChild(statusCell);

      const button = document.createElement("span");
      button.textContent = entry.status;
      button.classList = "status btn btn-outline-info";
      statusCell.appendChild(button);

      tableBody.appendChild(newRow);
    }
  }

  function getLastWord(fullName) {
    let words = fullName.split(/\s+/);

    // Get the last word (assuming there's at least one word in the name)
    let lastWord = words.reverse().find(word => word.trim() !== '');

    return lastWord;
}

  function displayFilters(data) {
    let authors = [];
    const dropdown = document.getElementById("dropdown-menu-author");

    data.postData.forEach((book) => {
      let authorName = getLastWord(book.author);

      if (!authors.includes(authorName)) {
        authors.push(authorName);
      }
    });

    authors.sort();

    authors.forEach((author) => {
      const span = document.createElement("span");
      span.classList = "dropdown-item";
      dropdown.appendChild(span);

      const div = document.createElement("div");
      div.classList = "form-check";
      span.appendChild(div);

      const input = document.createElement("input");
      input.classList = "form-check-input";
      input.id = `${author}Radio`;
      input.type = "radio";
      input.name = "author";
      input.value = author;
      div.appendChild(input);

      const label = document.createElement("label");
      label.classList = "form-check-label";
      label.for = `${author}Radio`;
      label.textContent = author;
      div.appendChild(label);
    });

    updateCheckboxes();

  }

  function updateCheckboxes(){
    checkboxes = document.querySelectorAll('input[type="radio"]');
    checkboxesStatus = document.querySelectorAll(
      'input[type="radio"][name="status"]'
    );
    checkboxesTitle = document.querySelectorAll(
      'input[type="radio"][name="title"]'
    );
    checkboxesAuthor = document.querySelectorAll(
      'input[type="radio"][name="author"]'
    );

    checkboxes.forEach(function (radioButton) {
      radioButton.addEventListener("change", function () {
        if (this.checked) {
          clearTimeout(typingTimer);
  
          typingTimer = setTimeout(function () {
            handleTypingFinished();
          }, typingDelay);
        }
      });
    });
  }

  function loadInitialData() {
    fetch("search.php", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    })
      .then((response) => response.json())
      .then((data) => {
        displayFilters(data);
        displayBooks(data);
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }

  loadInitialData();

  const searchInput = document.getElementById("searchInput");

  const typingDelay = 500;

  let typingTimer;

  searchInput.addEventListener("input", function () {
    clearTimeout(typingTimer);

    typingTimer = setTimeout(function () {
      handleTypingFinished();
    }, typingDelay);
  });

  searchInput.addEventListener("keyup", function (event) {
    if (event.key === "Enter") {
      clearTimeout(typingTimer);

      typingTimer = setTimeout(function () {
        handleTypingFinished();
      }, typingDelay);
    }
  });

  function handleTypingFinished() {
    let checkedValueStatus;
    let checkedValueTitle;
    let checkedValueAuthor;

    checkboxesStatus.forEach(function (checkbox) {
      if (checkbox.checked) {
        checkedValueStatus = checkbox.value;
      }
    });

    checkboxesTitle.forEach(function (checkbox) {
      if (checkbox.checked) {
        checkedValueTitle = checkbox.value;
      }
    });

    checkboxesAuthor.forEach(function (checkbox) {
      if (checkbox.checked) {
        checkedValueAuthor = checkbox.value;
      }
    });

    const postData = {
      searchInput: searchInput.value.toString(),
      statusFilters: checkedValueStatus,
      titleFilters: checkedValueTitle,
      authorFilters: checkedValueAuthor
    };

    while (tableBody.firstChild) {
      tableBody.removeChild(tableBody.firstChild);
    }

    fetch("search.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(postData),
    })
      .then((response) => response.json())
      .then((data) => {
        displayBooks(data);
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }
});