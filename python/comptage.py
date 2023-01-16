import uuid

from django.db import models

from plantation.models.parcelle import Parcelle
from plantation.models.passage import Passage
from plantation.models.pied import Pied
from utilisateur.models import Agent


class ComptageCacao(models.Model):
    class Meta:
        db_table = "tb_comptage_cacao"

    id = models.BigIntegerField(primary_key=True, blank=True, default=0, editable=False)
    uuid = models.UUIDField(unique=True, blank=True, default=None)
    passage = models.ForeignKey(Passage, on_delete=models.DO_NOTHING)
    fruit_a = models.IntegerField(default=0, db_column='fruit_a')
    fruit_b = models.IntegerField(default=0, db_column='fruit_b')
    fruit_c = models.IntegerField(default=0, db_column='fruit_c')
    fruit_d = models.IntegerField(default=0, db_column='fruit_d')
    pertes_a = models.IntegerField(default=0, db_column='pertes_a')
    pertes_b = models.IntegerField(default=0, db_column='pertes_b')
    aspect_a = models.TextField(blank=True, default="", db_column='aspect_a')
    aspect_b = models.TextField(blank=True, default="", db_column='aspect_b')
    aspect_c = models.TextField(blank=True, default="", db_column='aspect_c')
    aspect_d = models.TextField(blank=True, default="", db_column='aspect_d')
    fe = models.IntegerField(default=0)
    flo = models.IntegerField(default=0)
    pese_f = models.IntegerField(default=0, db_column='pese_f')
    Production_oct_mars = models.FloatField(default=0)
    Production_avril_sept = models.FloatField(default=0)

    auteur = models.ForeignKey(Agent, on_delete=models.DO_NOTHING)
    active = models.IntegerField(default=1)

    pied = models.ForeignKey(Pied, on_delete=models.DO_NOTHING, default=0)
    parcelle = models.ForeignKey(Parcelle, on_delete=models.DO_NOTHING, default=0)
    pied_code = models.CharField(max_length=30, blank=True, default=None)

    supp = models.IntegerField(default=0)
    id_sup = models.IntegerField(default=0, blank=True)
    id_modification = models.IntegerField(default=0, blank=True)

    date_creation = models.DateTimeField(auto_now_add=True, editable=False)
    date_modification = models.DateTimeField(auto_now=True)
    date_suppression = models.DateTimeField(auto_now=False, auto_created=False, default="", blank=True)

    def __str__(self):
        return "comptage cacao N° " + str(self.passage.numero_passage)

    def save(self, *args, **kwargs):
        if self.id is None or self.id == 0:
            try:
                self.id = ComptageCacao.objects.latest('id').id + 1
            except ComptageCacao.DoesNotExist:
                self.id = 1

        if self.uuid is None:
            try:
                self.uuid = uuid.uuid4()
            except Exception as e:
                self.uuid = uuid.uuid4()

        super(ComptageCacao, self).save()


class ComptageCafe(models.Model):
    class Meta:
        db_table = 'tb_comptage_cafe'

    id = models.BigIntegerField(primary_key=True, blank=True, default=0)
    uuid = models.UUIDField(unique=True, blank=True, default=None)
    passage = models.ForeignKey(Passage, on_delete=models.DO_NOTHING)
    nombre_grappe = models.IntegerField(db_column="grappe")
    nombre_fruit = models.IntegerField(db_column="fruit")
    fe = models.IntegerField(db_column='fe')
    peseF = models.IntegerField(db_column="pese_f")
    noue = models.IntegerField(db_column="noue")
    observation = models.TextField(blank=True, null=True)

    Production_oct_mars = models.FloatField(default=0)
    Production_avril_sept = models.FloatField(default=0)

    pied = models.ForeignKey(Pied, on_delete=models.DO_NOTHING)
    parcelle = models.ForeignKey(Parcelle, on_delete=models.DO_NOTHING)
    pied_code = models.CharField(max_length=30, blank=True, default=None)

    auteur = models.ForeignKey(Agent, on_delete=models.DO_NOTHING)
    active = models.IntegerField(default=1)

    supp = models.IntegerField(default=0)
    id_sup = models.IntegerField(null=True, blank=True)
    id_modification = models.IntegerField(null=True, blank=True)

    date_creation = models.DateTimeField(auto_now_add=True, editable=False)
    date_modification = models.DateTimeField(auto_now=True)
    date_suppression = models.DateTimeField(auto_now=False, auto_created=False, blank=True, null=True)

    def __str__(self):
        return "comptage cafe " + str(self.passage.numero_passage)

    def save(self, *args, **kwargs):
        if self.id is None or self.id == 0:
            try:
                self.id = ComptageCafe.objects.latest('id').id + 1
            except ComptageCafe.DoesNotExist:
                self.id = 1

        if self.uuid is None:
            try:
                self.uuid = uuid.uuid4()
            except Exception as e:
                self.uuid = uuid.uuid4()

        super(ComptageCafe, self).save()
