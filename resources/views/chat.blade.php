@extends('layouts.front')
@push('css')

@endpush
@section('content')
<div class="container">
   <div class="chat-warp" id="app">
      <div class="chat-inner">
        <div class="row">
           <div class="col-md-4">
               <div class="chat-right nicescroll-box">
                            <!-- Search Input -->
                  {{-- <div class="chat-search">
                      <form>
                          <input type="search" class="form-control" id="search-input" placeholder="بحث">
                          <button class="btn btn-link" type="button"><i class="fas fa-search"></i></button>
                      </form>
                  </div> --}}

                  @if(auth()->user()->Archivechats())
                    @foreach(auth()->user()->Archivechats() as $conv)
                       @php
                        if ($conv->from_id == auth()->id()) {
                          $OtherUser = \App\User::find($conv->to_id);
                        }else{
                          $OtherUser = \App\User::find($conv->from_id);
                        }

                        if(in_array($OtherUser->id, $conversation->toArray())){
                          $active = 'user-active';
                        }else{
                          $active = '';
                        }

                       @endphp

                       <!-- User Box -->
                       <a href="{{ url('conversation/'.$conv->id) }}">
                          <div class="user-box d-flex justify-content-between  {{ $active }}">
                              <div class="user-meta d-flex align-items-center">
                                  <div class="user-thumb">
                                      <img src="{{ ($OtherUser->avatar) ? $OtherUser->avatar : 'http://placehold.it/60.png/000/fff' }}" alt="{{ $OtherUser->user }}" />
                                  </div>
                                  <div class="user-data">
                                      <h3 class="user-nick">{{ $OtherUser->name ?? ''}}</h3>
                                      <p class="user-last-words">{{ $conv->lastMessage()->first()->content ?? ''}}</p>
                                  </div>
                              </div>
                              <div class="user-status">
                                  <div class="user-read read-on"><i class="fas fa-check"></i></div>
                                  <div class="user-last-time">{{ $conv->lastMessage()->first()->created_at->diffForHumans() ?? ''}}</div>
                              </div>
                          </div>
                        </a>
                    @endforeach
                  @endif

                </div>

            </div>

            <div class="col-md-8 col-md-offset-2">
              <div class="chat-height">
                      <!-- Chat Head -->

                      <div class="chat-head">
                          <div class="user-box d-flex justify-content-between align-items-center">
                              <div class="user-meta d-flex align-items-center">
                                  <div class="user-thumb">
                                      <img src="{{ ($OtherU->avatar) ? $OtherU->avatar : 'http://placehold.it/60.png/000/fff' }}" alt="{{ $OtherU->user }}" />
                                  </div>
                                  <div class="user-data">
                                      <h3 class="user-nick">{{ $OtherU->name }}</h3>
                                      {{-- <div class="user-on">متاح الأن</div> --}}
                                  </div>
                              </div>
                              {{--
                                <div class="chat-button">
                                  <a href="#" class="paperclip"><i class="fas fa-paperclip"></i></a>
                                  <a href="#" class="ellipsis"><i class="fas fa-ellipsis-v"></i></a>
                              </div>
                               --}}
                          </div>
                      </div>

                      <div class="chat-left chatwapper" ref="chatwapper">
                             <chat-messages :messages="messages" :user="{{ Auth::user() }}"></chat-messages>
                      </div>

                      <input type="hidden" name="conversation" id="conversation_id" value="{{ $id }}">
                    <!-- Chat Bottom -->
                    <chat-form
                            v-on:messagesent="addMessage"
                            :user="{{ Auth::user() }}"
                            :conversation_id="{{ $id }}"
                        ></chat-form>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
@push('js')
<script src="{{ asset('js/app.js') }}"></script>
@endpush