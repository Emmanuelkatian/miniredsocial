      <!-- Modal -->
      <div class="modal fade" id="editModal{{ $c->id }}"
        tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="exampleModalLabel">Editar Comentario
                    </h5>
                    <button type="button" class="close"
                        data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => '/comment/' . $c->id . '/edit', 'class' => 'form-horizontal']) !!}
                    <div class="input-group input-group-sm mb-0">
                        <input class="form-control form-control-sm"
                            value="{{ $c->body }}"
                            name="comment_body">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Cerrar</button>
                    <button type="submit"
                        class="btn btn-primary">Actualizar</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>