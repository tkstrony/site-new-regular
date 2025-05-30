<?php

namespace Phiki\Grammar;

use Phiki\Contracts\GrammarRepositoryInterface;

enum Grammar: string
{
    case Txt = 'txt';
    case Astro = 'astro';
    case Hy = 'hy';
    case Nim = 'nim';
    case Cpp = 'cpp';
    case Jinja = 'jinja';
    case Coq = 'coq';
    case Templ = 'templ';
    case GlimmerTs = 'glimmer-ts';
    case AngularHtml = 'angular-html';
    case Cmake = 'cmake';
    case Mdx = 'mdx';
    case Nix = 'nix';
    case Gdresource = 'gdresource';
    case Haxe = 'haxe';
    case Ada = 'ada';
    case Powerquery = 'powerquery';
    case Fluent = 'fluent';
    case ObjectiveC = 'objective-c';
    case Elixir = 'elixir';
    case Diff = 'diff';
    case Java = 'java';
    case Glsl = 'glsl';
    case Mojo = 'mojo';
    case Sparql = 'sparql';
    case Bicep = 'bicep';
    case Csv = 'csv';
    case Swift = 'swift';
    case SshConfig = 'ssh-config';
    case Edge = 'edge';
    case Narrat = 'narrat';
    case Tasl = 'tasl';
    case Nushell = 'nushell';
    case Erb = 'erb';
    case Move = 'move';
    case Scheme = 'scheme';
    case Mipsasm = 'mipsasm';
    case Rst = 'rst';
    case Shellscript = 'shellscript';
    case Apache = 'apache';
    case Wgsl = 'wgsl';
    case FortranFreeForm = 'fortran-free-form';
    case Ini = 'ini';
    case Make = 'make';
    case TsTags = 'ts-tags';
    case Stylus = 'stylus';
    case Jsx = 'jsx';
    case Jsonl = 'jsonl';
    case Twig = 'twig';
    case Clojure = 'clojure';
    case Svelte = 'svelte';
    case Xml = 'xml';
    case Jssm = 'jssm';
    case Erlang = 'erlang';
    case Applescript = 'applescript';
    case Viml = 'viml';
    case Razor = 'razor';
    case Apex = 'apex';
    case Berry = 'berry';
    case DreamMaker = 'dream-maker';
    case Wolfram = 'wolfram';
    case Cobol = 'cobol';
    case Proto = 'proto';
    case Genie = 'genie';
    case Wasm = 'wasm';
    case Handlebars = 'handlebars';
    case Zig = 'zig';
    case Vhdl = 'vhdl';
    case Go = 'go';
    case Fish = 'fish';
    case Solidity = 'solidity';
    case Sas = 'sas';
    case FortranFixedForm = 'fortran-fixed-form';
    case R = 'r';
    case Fennel = 'fennel';
    case Ruby = 'ruby';
    case Log = 'log';
    case Vala = 'vala';
    case Splunk = 'splunk';
    case Lua = 'lua';
    case Gnuplot = 'gnuplot';
    case Regexp = 'regexp';
    case Markdown = 'markdown';
    case Ballerina = 'ballerina';
    case Xsl = 'xsl';
    case Systemd = 'systemd';
    case Coffee = 'coffee';
    case Haml = 'haml';
    case Wikitext = 'wikitext';
    case Kusto = 'kusto';
    case Ocaml = 'ocaml';
    case Cue = 'cue';
    case Nextflow = 'nextflow';
    case GitRebase = 'git-rebase';
    case Cypher = 'cypher';
    case Tsx = 'tsx';
    case Bibtex = 'bibtex';
    case Pug = 'pug';
    case GlimmerJs = 'glimmer-js';
    case Julia = 'julia';
    case Beancount = 'beancount';
    case Puppet = 'puppet';
    case Bsl = 'bsl';
    case Http = 'http';
    case Csharp = 'csharp';
    case Jison = 'jison';
    case Purescript = 'purescript';
    case Actionscript3 = 'actionscript-3';
    case Shellsession = 'shellsession';
    case SystemVerilog = 'system-verilog';
    case Gdscript = 'gdscript';
    case Luau = 'luau';
    case Toml = 'toml';
    case Php = 'php';
    case Typst = 'typst';
    case Postcss = 'postcss';
    case Prisma = 'prisma';
    case Fsharp = 'fsharp';
    case Apl = 'apl';
    case Sql = 'sql';
    case ObjectiveCpp = 'objective-cpp';
    case Logo = 'logo';
    case Blade = 'blade';
    case Yaml = 'yaml';
    case Scala = 'scala';
    case Codeql = 'codeql';
    case Crystal = 'crystal';
    case Sdbl = 'sdbl';
    case Hjson = 'hjson';
    case Awk = 'awk';
    case Docker = 'docker';
    case Dax = 'dax';
    case AngularTs = 'angular-ts';
    case Terraform = 'terraform';
    case Typespec = 'typespec';
    case Codeowners = 'codeowners';
    case Rel = 'rel';
    case VueHtml = 'vue-html';
    case Abap = 'abap';
    case GitCommit = 'git-commit';
    case Rust = 'rust';
    case Polar = 'polar';
    case Javascript = 'javascript';
    case Prolog = 'prolog';
    case Dart = 'dart';
    case Marko = 'marko';
    case Asciidoc = 'asciidoc';
    case Wenyan = 'wenyan';
    case Elm = 'elm';
    case D = 'd';
    case Hlsl = 'hlsl';
    case Po = 'po';
    case Shaderlab = 'shaderlab';
    case Stata = 'stata';
    case Nginx = 'nginx';
    case Ara = 'ara';
    case Json = 'json';
    case Css = 'css';
    case Tsv = 'tsv';
    case Vb = 'vb';
    case Hcl = 'hcl';
    case Plsql = 'plsql';
    case Pascal = 'pascal';
    case C = 'c';
    case Turtle = 'turtle';
    case Qmldir = 'qmldir';
    case JinjaHtml = 'jinja-html';
    case Racket = 'racket';
    case Scss = 'scss';
    case Hxml = 'hxml';
    case Qml = 'qml';
    case CommonLisp = 'common-lisp';
    case Lean = 'lean';
    case Tex = 'tex';
    case Jsonnet = 'jsonnet';
    case Vyper = 'vyper';
    case Html = 'html';
    case Liquid = 'liquid';
    case EmacsLisp = 'emacs-lisp';
    case V = 'v';
    case Hack = 'hack';
    case Latex = 'latex';
    case Perl = 'perl';
    case Gleam = 'gleam';
    case Cairo = 'cairo';
    case Matlab = 'matlab';
    case Jsonc = 'jsonc';
    case Dotenv = 'dotenv';
    case Raku = 'raku';
    case Less = 'less';
    case Bat = 'bat';
    case Clarity = 'clarity';
    case Reg = 'reg';
    case CppMacro = 'cpp-macro';
    case Tcl = 'tcl';
    case HtmlDerivative = 'html-derivative';
    case Powershell = 'powershell';
    case Graphql = 'graphql';
    case Haskell = 'haskell';
    case Gdshader = 'gdshader';
    case Groovy = 'groovy';
    case Qss = 'qss';
    case Verilog = 'verilog';
    case Typescript = 'typescript';
    case Kotlin = 'kotlin';
    case Gherkin = 'gherkin';
    case Soy = 'soy';
    case Python = 'python';
    case Sass = 'sass';
    case Talonscript = 'talonscript';
    case Vue = 'vue';
    case Zenscript = 'zenscript';
    case Imba = 'imba';
    case Riscv = 'riscv';
    case Smalltalk = 'smalltalk';
    case Json5 = 'json5';
    case Cadence = 'cadence';
    case Desktop = 'desktop';
    case Asm = 'asm';
    case Antlers = 'antlers';

    public function toParsedGrammar(GrammarRepositoryInterface $repository): ParsedGrammar
    {
        return $repository->get($this->value);
    }
}
