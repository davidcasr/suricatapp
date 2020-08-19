@extends('errors::illustrated-layout')

@section('title', __('Error 403'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
