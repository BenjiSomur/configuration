from mdgparser import get_nodes, create_table, get_globals
from initializer import *
from operators import init_population, tournament, crossover, mutation, dominance_sort
from fitness import Fitness
from decoder import decode
from dotgrapher import create_graph
import sys
import os
from copy import deepcopy
from psutil import virtual_memory

total_memory = virtual_memory().available
cache_percent = 0.03
cache_sisze = int(total_memory * cache_percent)
