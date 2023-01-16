import uuid

from django.db import models

from plantation.models.parcelle import Parcelle
from plantation.models.passage import Passage
from plantation.models.pied import Pied
from utilisateur.models import Agent
from utilisateur.models import Village


class ComptageCacao(models.Model):
    class Meta:
        db_table = "tb_comptage_cacao"

    id = models.BigIntegerField(primary_key=True, blank=True, default=0, editable=False)
    uuid = models.UUIDField(unique=True, blank=True, default=None)
    idpassage = models.ForeignKey(Passage, on_delete=models.DO_NOTHING)
    fruit_a = models.IntegerField(default=0, db_column='fruit_a',null=true)
    fruit_b = models.IntegerField(default=0, db_column='fruit_b',null=true)
    fruit_c = models.IntegerField(default=0, db_column='fruit_c',null=true)
    fruit_d = models.IntegerField(default=0, db_column='fruit_d',null=true)
    pertes_a = models.IntegerField(default=0, db_column='pertes_a',null=true)
    pertes_b = models.IntegerField(default=0, db_column='pertes_b',null=true)
    aspect_a = models.TextField(blank=True, default="", db_column='aspect_a',null=true)
    aspect_b = models.TextField(blank=True, default="", db_column='aspect_b',null=true)
    aspect_c = models.TextField(blank=True, default="", db_column='aspect_c',null=true)
    aspect_d = models.TextField(blank=True, default="", db_column='aspect_d',null=true)
    fe = models.IntegerField(default=0,null=true)
    flo = models.IntegerField(default=0,null=true)
    Noue = models.IntegerField(default=0,null=true)
    pese_f = models.FloatField(default=0, db_column='pese_f')
    Production_oct_mars = models.FloatField(default=0)
    Production_avril_sept = models.FloatField(default=0)
    posX = models.CharField(default=0)
    posY = models.CharField(default=0)
    an_campagne = models.CharField(default=0)

    agent_id = models.ForeignKey(Agent, on_delete=models.DO_NOTHING)
    village_code = models.ForeignKey(Village, on_delete=models.DO_NOTHING)
    active = models.IntegerField(default=1)

    pied = models.ForeignKey(Pied, on_delete=models.DO_NOTHING, default=0)
    parcelle_code = models.ForeignKey(Parcelle, on_delete=models.DO_NOTHING, default=0)
    pied_code = models.CharField(max_length=30, blank=True, default=None)
    raison_supp = models.TextField(max_length=30, blank=True, default=None)

    supp = models.IntegerField(default=0)
    id_supp = models.IntegerField(default=0, blank=True)
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
    idpassage = models.ForeignKey(Passage, on_delete=models.DO_NOTHING)
       grappe = models.IntegerField(default=0, db_column='grappe',null=true)
       fruit = models.IntegerField(default=0, db_column='fruit',null=true)
       Fe = models.IntegerField(default=0, db_column='Fe',null=true)
       Flo = models.IntegerField(default=0, db_column='peseF',null=true)
       peseF = models.IntegerField(default=0, db_column='pertes_a',null=true)
       Noue = models.IntegerField(default=0, db_column='Noue',null=true)

       Production_oct_mars = models.FloatField(default=0)
       Production_avril_sept = models.FloatField(default=0)
       posX = models.CharField(default=0)
       posY = models.CharField(default=0)
       an_campagne = models.CharField(default=0)

       agent_id = models.ForeignKey(Agent, on_delete=models.DO_NOTHING)
       village_code = models.ForeignKey(Village, on_delete=models.DO_NOTHING)
       active = models.IntegerField(default=1)

       pied = models.ForeignKey(Pied, on_delete=models.DO_NOTHING, default=0)
       parcelle_code = models.ForeignKey(Parcelle, on_delete=models.DO_NOTHING, default=0)
       pied_code = models.CharField(max_length=50, blank=True, default=None)
       raison_supp = models.TextField(max_length=30, blank=True, default=None)

       supp = models.IntegerField(default=0)
       id_supp = models.IntegerField(default=0, blank=True)
       id_modification = models.IntegerField(default=0, blank=True)

       date_creation = models.DateTimeField(auto_now_add=True, editable=False)
       date_modification = models.DateTimeField(auto_now=True)
       date_suppression = models.DateTimeField(auto_now=False, auto_created=False, default="", blank=True)


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
