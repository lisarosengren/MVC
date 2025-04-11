<?php

namespace App\Card;

class CardGraphic extends Card
{
    protected $value;

    private $representation = [
        "Ace of Spades" => "<div class='black'>&#127137</div>",
        "Two of Spades" => "<div class='black'>&#127138</div>",
        "Three of Spades" => "<div class='black'>&#127139</div>",
        "Four of Spades" => "<div class='black'>&#127140</div>",
        "Five of Spades" => "<div class='black'>&#127141</div>",
        "Six of Spades" => "<div class='black'>&#127142</div>",
        "Seven of Spades" => "<div class='black'>&#127143</div>",
        "Eight of Spades" => "<div class='black'>&#127144</div>",
        "Nine of Spades" => "<div class='black'>&#127145</div>",
        "Ten of Spades" => "<div class='black'>&#127146</div>",
        "Jack of Spades" => "<div class='black'>&#127147</div>",
        "Queen of Spades" => "<div class='black'>&#127149</div>",
        "King of Spades" => "<div class='black'>&#127150</div>",
        "Ace of Hearts" => "<div class='red'>&#127153</div>",
        "Two of Hearts" => "<div class='red'>&#127154</div>",
        "Three of Hearts" => "<div class='red'>&#127155</div>",
        "Four of Hearts" => "<div class='red'>&#127156</div>",
        "Five of Hearts" => "<div class='red'>&#127157</div>",
        "Six of Hearts" => "<div class='red'>&#127158</div>",
        "Seven of Hearts" => "<div class='red'>&#127159</div>",
        "Eight of Hearts" => "<div class='red'>&#127160</div>",
        "Nine of Hearts" => "<div class='red'>&#127161</div>",
        "Ten of Hearts" => "<div class='red'>&#127162</div>",
        "Jack of Hearts" => "<div class='red'>&#127163</div>",
        "Queen of Hearts" => "<div class='red'>&#127165</div>",
        "King of Hearts" => "<div class='red'>&#127166</div>",
        "Ace of Diamonds" => "<div class='red'>&#127169</div>",
        "Two of Diamonds" => "<div class='red'>&#127170</div>",
        "Three of Diamonds" => "<div class='red'>&#127171</div>",
        "Four of Diamonds" => "<div class='red'>&#127172</div>",
        "Five of Diamonds" => "<div class='red'>&#127173</div>",
        "Six of Diamonds" => "<div class='red'>&#127174</div>",
        "Seven of Diamonds" => "<div class='red'>&#127175</div>",
        "Eight of Diamonds" => "<div class='red'>&#127176</div>",
        "Nine of Diamonds" => "<div class='red'>&#127177</div>",
        "Ten of Diamonds" => "<div class='red'>&#127178</div>",
        "Jack of Diamonds" => "<div class='red'>&#127179</div>",
        "Queen of Diamonds" => "<div class='red'>&#127181</div>",
        "King of Diamonds" => "<div class='red'>&#127182</div>",
        "Ace of Clubs" => "<div class='black'>&#127185</div>",
        "Two of Clubs" => "<div class='black'>&#127186</div>",
        "Three of Clubs" => "<div class='black'>&#127187</div>",
        "Four of Clubs" => "<div class='black'>&#127188</div>",
        "Five of Clubs" => "<div class='black'>&#127189</div>",
        "Six of Clubs" => "<div class='black'>&#127190</div>",
        "Seven of Clubs" => "<div class='black'&#127191</div>",
        "Eight of Clubs" => "<div class='black'>&#127192</div>",
        "Nine of Clubs" => "<div class='black'>&#127193</div>",
        "Ten of Clubs" => "<div class='black'>&#127194</div>",
        "Jack of Clubs" => "<div class='black'>&#127195</div>",
        "Queen of Clubs" => "<div class='black'>&#127197</div>",
        "King of Clubs" => "<div class='black'>&#127198</div>",    
    ];

    public function __construct($value)
    {
        parent::__construct($value);
    }

    public function getAsString(): string
    {
        return $this->representation[$this->value];
    }
}