<div class="container-row">
  <div class="row">
      <div class="col-3">
          <table class="table table-striped">
              <thead>
              <tr>
                  <th scope="col">Actions à réaliser en tant qu'administrateur:</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                  <th scope="row"><button type="button" class="btn btn-light" onclick="afficherUser()">Gérer les utilisateurs</button></th>
              </tr>
              <tr>
                  <th scope="row"><button type="button" class="btn btn-light" onclick="afficherDispo()">Gérer les disponibilité des salles</button></th>
              </tr>
              <tr>
                  <th scope="row"><button type="button" class="btn btn-light" onclick="afficherSalles()">Ajouter/Supprimer salles</button></th>
              </tr>
              <tr>
                  <th scope="row"><button type="button" class="btn btn-light" onclick="afficherCreneau()">Ajouter/Supprimer crénaux</button></th>
              </tr>
              </tbody>
          </table>
          <div id="resultAjax">
          </div>
      </div>
      <div class="col-9" id="tableAdmin">

      </div>

  </div>
</div>



<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalBody">
                ...
            </div>
            <div class="modal-footer" id="modalFooter">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning" id="modalAction"></button>
            </div>
        </div>
    </div>
</div>

<script src="/js/admin.js" type="text/javascript"></script>
