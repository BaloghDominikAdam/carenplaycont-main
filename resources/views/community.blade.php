@extends('layout')
@section('content')
    <main>
        <section class="welcomeblade2">
            <div class="comm">
                <h1>Közösségi felület</h1>

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ujbej">
                        Új bejegyzés hozzáadása!
                      </button>
                      <div class="modal fade" id="ujbej" tabindex="-1" aria-labelledby="ujbejModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="ujbej">Új bejegyzés posztolás!</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Bezárás</button>
                                </div>
                                <div class="modal-body">



                                    @if (Auth::check())
                                    <form action="/community" method="post">
                                        @csrf
                                        <div class="py-2">
                                            <label for="nev" id="nev" class="form-label">Név: <span class="text-danger">*</span></label>
                                            <input type="text" name="nev" id="nev" class="form-control">
                                            @error('nev')
                                                <p class="text-danger"><b>{{ $message }}</b></p>
                                            @enderror
                                        </div>
                                        <div class="py-2">
                                            <label for="email" id="email" class="form-label">E-mail: <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="email" id="email" class="form-control">
                                            @error('email')
                                                <p class="text-danger"><b>{{ $message }}</b></p>
                                            @enderror
                                        </div>
                                        <div class="py-2">
                                            <label for="message" id="message" class="form-label">Üzenet: <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="message" id="message" rows="6" class="form-control"></textarea>
                                            @error('message')
                                                <p class="text-danger"><b>{{ $message }}</b></p>
                                            @enderror
                                        </div>
                                        <div class="py-2">
                                            <span class="text-danger" style="font-size: 15px">* kötelező megadni</span>
                                        </div>
                                        <div class="py-3">
                                            <button type="submit" class="btn btn-outline-primary">Beküld</button>
                                        </div>


                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

            @else
                <hr>
                <h1 class="text-center py-2"> Ha szeretne a vendégkönybe írni akkor jelentkezzen be, vagy regisztráljon!</h1>
            @endif
            </div>

        </section>
    </main>
@endsection
