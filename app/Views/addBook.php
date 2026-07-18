<section id="add-book-form" class="flex-col">

    <div id="add-header-section" class="flex-col gap-1">
        <h1>Ajouter un livre</h1>
    </div>

    <article class="flex gap-2">

            
            <form class="flex" method="POST" action="index.php?action=addBook" enctype="multipart/form-data">
                <div class="flex-col gap-1">
                    <label>Photo</label>
                    <img src="./../public/uploads/books/defaultCover.png" alt="Couverture livre">
                    <label for="newBookPicture">Modifier la photo</label>
                    <input type="file" name="newBookPicture" id="newBookPicture">
                </div>

                <div class="flex-col gap-1" id="new-book-info">
                    <label for="newTitle">Titre</label>
                    <input type="text" name="newTitle" id="newTitle">

                    <label for="newAuthor">Auteur</label>
                    <input type="text" name="newAuthor" id="newAuthor">

                    <label for="newDescription">Commentaire</label>
                    <textarea id="newDescription" rows="20" name="newDescription"></textarea>

                    <label for="availability">Disponibilité</label>
                    <select name="availability" id="availability">
                        <option value="1">
                            Disponible
                        </option>

                        <option value="0">
                            Non Disponible
                        </option>
                    </select>

                    <button class="btn btn-primary">Valider</button>
                </div>
            </form>
    </article>
</section>