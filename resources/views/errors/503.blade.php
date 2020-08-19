@extends('errors::illustrated-layout')

@section('title', __('Error 503'))
@section('code', '503')
@section('message', __($exception->getMessage() ?: 'Service Unavailable'))
