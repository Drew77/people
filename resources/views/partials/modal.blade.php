        <!-- Modal -->
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

              </div>
              <form class="col-12 edit__user__form mb-5" method="POST" enctype="multipart/form-data">
                  {{ csrf_field() }} 
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" name="Name" id="name" aria-describedby="name" placeholder="Users Name">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleFormControlFile1">Users Image</label>
                    <input type="file" class="form-control-file" name="Picture" id="exampleFormControlFile1">
                  </div>
                  
                  <button type="submit" class="btn btn-success">Update</button>
              </form>
              
              <form class="col-12 delete__user__form mb-5">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  {{ method_field('delete') }}
                  <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </div>
          </div>
        </div>